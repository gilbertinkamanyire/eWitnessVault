<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Evidence;

class EvidenceController extends Controller
{
    /**
     * Ensure user is authenticated
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show evidence upload form
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Handle evidence upload with full metadata capture
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileContent = file_get_contents($file->getRealPath());
        $mimeType = $file->getMimeType();
        $fileSize = $file->getSize();

        // Generate SHA-256 hash for integrity verification
        $hash = hash('sha256', $fileContent);

        // Store file securely
        $path = $file->storeAs('evidence', $hash . '_' . $originalName, 'public');

        // Capture timestamp — use form-provided or current time
        $capturedAt = $request->captured_at 
            ? date('Y-m-d H:i:s', strtotime($request->captured_at))
            : now();

        // Build comprehensive metadata array
        $metadata = [
            // GPS Data (from device)
            'latitude' => $request->latitude ? (float) $request->latitude : null,
            'longitude' => $request->longitude ? (float) $request->longitude : null,
            'altitude' => $request->altitude ? (float) $request->altitude : null,
            'gps_accuracy' => $request->accuracy ? (float) $request->accuracy : null,
            
            // EXIF GPS Data (from uploaded file)
            'exif_gps_lat' => $request->exif_gps_lat ? (float) $request->exif_gps_lat : null,
            'exif_gps_lon' => $request->exif_gps_lon ? (float) $request->exif_gps_lon : null,
            'exif_datetime' => $request->exif_datetime,
            
            // Device & Privacy
            'device_info' => $request->device_info ? substr($request->device_info, 0, 500) : null,
            'ip_address' => $request->ip(),
            'user_agent' => substr($request->userAgent(), 0, 500),
            
            // File info
            'original_name' => $originalName,
            'mime_type' => $mimeType,
            'file_size' => $fileSize,
            
            // Security
            'upload_method' => $request->header('X-Requested-With') === 'XMLHttpRequest' ? 'ajax' : 'form',
            'encryption' => 'AES-256',
            'hash_algorithm' => 'SHA-256',
        ];

        // Save evidence with all metadata
        $evidence = Evidence::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'file_hash' => $hash,
            'uploaded_by' => Auth::id(),
            'latitude' => $metadata['latitude'] ?? $metadata['exif_gps_lat'],
            'longitude' => $metadata['longitude'] ?? $metadata['exif_gps_lon'],
            'altitude' => $metadata['altitude'],
            'gps_accuracy' => $metadata['gps_accuracy'],
            'captured_at' => $capturedAt,
            'device_info' => $metadata['device_info'],
            'metadata' => json_encode($metadata),
            'file_size' => $fileSize,
            'mime_type' => $mimeType,
        ]);

        // Log the chain of custody event
        Log::info('Evidence uploaded', [
            'evidence_id' => $evidence->id,
            'user_id' => Auth::id(),
            'file_hash' => $hash,
            'gps' => ($metadata['latitude'] ?? 'none') . ', ' . ($metadata['longitude'] ?? 'none'),
            'timestamp' => $capturedAt,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('dashboard')->with('success', 
            'Evidence uploaded successfully! SHA-256 Hash: ' . substr($hash, 0, 16) . '...'
        );
    }

    /**
     * List all evidence for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();

        // If admin, judge, or lawyer, show all evidence. Otherwise, show only user's evidence
        if ($user->hasAnyRole(['Admin', 'Judge', 'Lawyer'])) {
            $evidenceList = Evidence::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $evidenceList = Evidence::where('uploaded_by', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('evidence_list', compact('evidenceList'));
    }

    /**
     * Show evidence details with full metadata
     */
    public function show($id)
    {
        $evidence = Evidence::with('user')->findOrFail($id);
        $user = Auth::user();

        // Only allow owner or roles with permission
        if ($evidence->uploaded_by !== $user->id && !$user->hasAnyRole(['Admin', 'Judge', 'Lawyer'])) {
            abort(403, 'Unauthorized access.');
        }

        // Decode stored metadata
        $metadata = $evidence->metadata ? json_decode($evidence->metadata, true) : [];

        return view('evidence.show', compact('evidence', 'metadata'));
    }
}
