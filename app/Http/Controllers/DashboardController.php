<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evidence;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Ensure user is authenticated
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display role-specific dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Check if user is verified
        if (!$user->is_verified && $user->hasAnyRole(['Judge', 'Lawyer'])) {
            return view('dashboard-pending');
        }

        // Redirect admin to admin dashboard
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        // Fetch evidence based on role
        if ($user->hasAnyRole(['Judge', 'Investigator'])) {
            // Judges and Investigators can see all evidence
            $evidenceList = Evidence::orderBy('created_at', 'desc')->get();
        } else {
            // Regular users and Lawyers see only their own evidence
            $evidenceList = Evidence::where('uploaded_by', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Role-specific statistics
        $stats = $this->getRoleStats($user);

        // Role-specific features
        $features = $this->getRoleFeatures($user);

        return view('dashboard', compact('user', 'evidenceList', 'stats', 'features'));
    }

    /**
     * Get role-specific statistics
     */
    private function getRoleStats($user)
    {
        $stats = [
            'user_evidence' => Evidence::where('uploaded_by', $user->id)->count(),
            'total_evidence' => Evidence::count(),
            'total_users' => User::count(),
            'verified_users' => User::where('is_verified', true)->count(),
        ];

        // Role-specific stats
        if ($user->hasRole('Judge')) {
            $stats['pending_review'] = Evidence::where('status', 'pending')->count();
            $stats['reviewed_cases'] = Evidence::where('reviewed_by', $user->id)->count();
        }

        if ($user->hasRole('Lawyer')) {
            $stats['active_cases'] = Evidence::where('uploaded_by', $user->id)
                ->where('status', 'active')->count();
            $stats['closed_cases'] = Evidence::where('uploaded_by', $user->id)
                ->where('status', 'closed')->count();
        }

        if ($user->hasRole('Investigator')) {
            $stats['assigned_cases'] = Evidence::where('assigned_to', $user->id)->count();
            $stats['total_evidence'] = Evidence::count();
        }

        return $stats;
    }

    /**
     * Get role-specific features
     */
    private function getRoleFeatures($user)
    {
        $features = [
            'can_view_all' => $user->hasAnyRole(['Judge', 'Investigator', 'Admin']),
            'can_upload' => true,
            'can_review' => $user->hasRole('Judge'),
            'can_assign' => $user->hasAnyRole(['Admin', 'Investigator']),
            'role_name' => $this->getRoleName($user),
            'role_icon' => $this->getRoleIcon($user),
        ];

        return $features;
    }

    /**
     * Get primary role name
     */
    private function getRoleName($user)
    {
        if ($user->hasRole('Judge')) return 'Judge';
        if ($user->hasRole('Lawyer')) return 'Lawyer';
        if ($user->hasRole('Investigator')) return 'Investigator';
        if ($user->hasRole('Admin')) return 'Administrator';
        return 'User';
    }

    /**
     * Get role icon
     */
    private function getRoleIcon($user)
    {
        if ($user->hasRole('Judge')) return 'ti-gavel';
        if ($user->hasRole('Lawyer')) return 'ti-briefcase';
        if ($user->hasRole('Investigator')) return 'ti-search';
        if ($user->hasRole('Admin')) return 'ti-shield-cog';
        return 'ti-user';
    }
}