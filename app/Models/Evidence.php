<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Evidence extends Model
{
    use HasFactory;

    protected $table = 'evidence';

    /**
     * Fillable fields for mass assignment
     * Includes all GPS, timestamp, device, and privacy metadata
     */
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_hash',
        'file_size',
        'mime_type',
        'uploaded_by',
        'status',
        'assigned_to',
        'reviewed_by',
        'latitude',
        'longitude',
        'altitude',
        'gps_accuracy',
        'captured_at',
        'device_info',
        'metadata',
    ];

    /**
     * Type casting for proper data handling
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'altitude' => 'decimal:2',
        'gps_accuracy' => 'decimal:2',
        'file_size' => 'integer',
        'captured_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Evidence belongs to a user (uploaded_by)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Relationship: Evidence is assigned to a user (Investigator)
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relationship: Evidence is reviewed by a user (Judge)
     */
    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Accessor for file URL (secure public storage)
     */
    public function getFileUrlAttribute()
    {
        return Storage::disk('public')->url($this->file_path);
    }
    
    /**
     * Get the full storage path
     */
    public function getStoragePath()
    {
        return storage_path('app/public/' . $this->file_path);
    }

    /**
     * Check if evidence has GPS coordinates
     */
    public function hasGPS(): bool
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    /**
     * Get formatted GPS string
     */
    public function getFormattedGPSAttribute(): string
    {
        if (!$this->hasGPS()) return 'No GPS data';
        return number_format($this->latitude, 6) . ', ' . number_format($this->longitude, 6);
    }

    /**
     * Get file extension
     */
    public function getFileExtensionAttribute(): string
    {
        return strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));
    }

    /**
     * Check if the file is an image
     */
    public function getIsImageAttribute(): bool
    {
        return in_array($this->file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }

    /**
     * Check if the file is a video
     */
    public function getIsVideoAttribute(): bool
    {
        return in_array($this->file_extension, ['mp4', 'webm', 'ogg', 'avi', 'mov']);
    }

    /**
     * Check if the file is a PDF
     */
    public function getIsPdfAttribute(): bool
    {
        return $this->file_extension === 'pdf';
    }

    /**
     * Get human-readable file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $size = $this->file_size;
        if (!$size) return 'Unknown';
        if ($size < 1024) return $size . ' B';
        if ($size < 1048576) return round($size / 1024, 1) . ' KB';
        return round($size / 1048576, 1) . ' MB';
    }

    /**
     * Get decoded metadata as array
     */
    public function getDecodedMetadataAttribute(): array
    {
        return $this->metadata ? json_decode($this->metadata, true) : [];
    }
}
