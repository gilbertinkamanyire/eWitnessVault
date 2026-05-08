<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ti ti-file-certificate" style="font-size: 1.5rem; background: linear-gradient(135deg, #06b6d4, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #e2e8f0; font-family: 'Outfit', sans-serif;">Evidence Details</h2>
            </div>
            <a href="{{ route('evidence.index') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.875rem; color: #64748b; text-decoration: none; transition: all 0.2s; font-family: 'Outfit', sans-serif;"
               onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#64748b'">
                <i class="ti ti-arrow-left"></i> Back to Evidence List
            </a>
        </div>
    </x-slot>

    <div style="padding: 2rem 1rem; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 1000px; margin: 0 auto;">
            
            <!-- Responsive Grid: Main + Sidebar -->
            <div class="evidence-detail-grid" style="display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem;">
                <!-- Main Content -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem; min-width: 0;">
                    <!-- Media Card -->
                    <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(34, 211, 238, 0.15); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
                        <div style="padding: 1rem; background: rgba(0,0,0,0.2);">
                            @if($evidence->is_image)
                                <img src="{{ $evidence->file_url }}" alt="{{ $evidence->title }}" style="width: 100%; height: auto; border-radius: 12px; display: block; max-height: 500px; object-fit: contain;">
                            @elseif($evidence->is_video)
                                <video controls style="width: 100%; border-radius: 12px; max-height: 500px;">
                                    <source src="{{ $evidence->file_url }}" type="{{ $evidence->mime_type ?? 'video/' . $evidence->file_extension }}">
                                    Your browser does not support video playback.
                                </video>
                            @elseif($evidence->is_pdf)
                                <iframe src="{{ $evidence->file_url }}" style="width: 100%; height: 500px; border: none; border-radius: 12px;"></iframe>
                            @else
                                <div style="padding: 4rem 2rem; text-align: center;">
                                    <i class="ti ti-file-unknown" style="font-size: 4rem; color: #334155; display: block; margin-bottom: 1rem;"></i>
                                    <div style="color: #94a3b8;">Preview not available for {{ strtoupper($evidence->file_extension) }} files.</div>
                                </div>
                            @endif
                        </div>

                        <div style="padding: 1.5rem 2rem; border-top: 1px solid rgba(71,85,105,0.3);">
                            <h3 style="font-size: 1.5rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem; word-break: break-word;">{{ $evidence->title }}</h3>
                            <p style="font-size: 0.9375rem; color: #94a3b8; line-height: 1.6;">{{ $evidence->description ?: 'No description provided.' }}</p>
                            
                            <!-- Quick tags -->
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem;">
                                <span class="chain-tag"><i class="ti ti-lock"></i> AES-256 Encrypted</span>
                                <span class="chain-tag"><i class="ti ti-fingerprint"></i> SHA-256 Verified</span>
                                @if($evidence->hasGPS())
                                    <span class="chain-tag" style="background: rgba(16,185,129,0.1); border-color: rgba(16,185,129,0.2); color: #6ee7b7;"><i class="ti ti-map-pin-check"></i> GPS Verified</span>
                                @endif
                                @if($evidence->captured_at)
                                    <span class="chain-tag" style="background: rgba(6,182,212,0.1); border-color: rgba(6,182,212,0.2); color: #67e8f9;"><i class="ti ti-clock-check"></i> Timestamped</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Cryptographic Integrity Card -->
                    <div style="background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(10px); border: 1px solid rgba(34, 211, 238, 0.1); border-radius: 16px; padding: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1rem;">
                            <i class="ti ti-fingerprint" style="color: #22d3ee; font-size: 1.25rem;"></i>
                            <span style="font-size: 0.875rem; font-weight: 700; color: #cbd5e1; text-transform: uppercase; letter-spacing: 0.5px;">Cryptographic Integrity</span>
                        </div>
                        <div style="background: rgba(0,0,0,0.3); padding: 1rem; border-radius: 10px; border: 1px solid rgba(71,85,105,0.2);">
                            <div style="font-size: 0.75rem; color: #475569; margin-bottom: 0.4rem; font-weight: 600;">SHA-256 HASH</div>
                            <div style="font-family: monospace; font-size: 0.75rem; color: #22d3ee; word-break: break-all; line-height: 1.5;">{{ $evidence->file_hash }}</div>
                        </div>
                        @if($evidence->file_size)
                        <div style="display: flex; gap: 1rem; margin-top: 1rem; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 120px; background: rgba(0,0,0,0.2); padding: 0.75rem; border-radius: 8px;">
                                <div style="font-size: 0.6875rem; color: #475569; font-weight: 700; text-transform: uppercase; margin-bottom: 0.25rem;">File Size</div>
                                <div style="font-size: 0.875rem; color: #e2e8f0; font-weight: 600;">{{ $evidence->formatted_size }}</div>
                            </div>
                            <div style="flex: 1; min-width: 120px; background: rgba(0,0,0,0.2); padding: 0.75rem; border-radius: 8px;">
                                <div style="font-size: 0.6875rem; color: #475569; font-weight: 700; text-transform: uppercase; margin-bottom: 0.25rem;">File Type</div>
                                <div style="font-size: 0.875rem; color: #e2e8f0; font-weight: 600;">{{ strtoupper($evidence->file_extension) }}</div>
                            </div>
                            @if($evidence->mime_type)
                            <div style="flex: 1; min-width: 120px; background: rgba(0,0,0,0.2); padding: 0.75rem; border-radius: 8px;">
                                <div style="font-size: 0.6875rem; color: #475569; font-weight: 700; text-transform: uppercase; margin-bottom: 0.25rem;">MIME</div>
                                <div style="font-size: 0.8125rem; color: #e2e8f0; font-weight: 600; word-break: break-all;">{{ $evidence->mime_type }}</div>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- GPS & Location Data Card -->
                    @if($evidence->hasGPS() || isset($metadata['exif_gps_lat']))
                    <div style="background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(10px); border: 1px solid rgba(16, 185, 129, 0.15); border-radius: 16px; padding: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1rem;">
                            <i class="ti ti-map-pin-check" style="color: #10b981; font-size: 1.25rem;"></i>
                            <span style="font-size: 0.875rem; font-weight: 700; color: #6ee7b7; text-transform: uppercase; letter-spacing: 0.5px;">GPS & Location Data</span>
                        </div>
                        <div class="metadata-panel">
                            <div class="metadata-item">
                                <span class="metadata-label">Latitude</span>
                                <span class="metadata-value verified">{{ $evidence->latitude ? number_format($evidence->latitude, 8) : '—' }}</span>
                            </div>
                            <div class="metadata-item">
                                <span class="metadata-label">Longitude</span>
                                <span class="metadata-value verified">{{ $evidence->longitude ? number_format($evidence->longitude, 8) : '—' }}</span>
                            </div>
                            <div class="metadata-item">
                                <span class="metadata-label">Altitude</span>
                                <span class="metadata-value">{{ $evidence->altitude ? number_format($evidence->altitude, 1) . 'm' : '—' }}</span>
                            </div>
                            <div class="metadata-item">
                                <span class="metadata-label">Accuracy</span>
                                <span class="metadata-value">{{ $evidence->gps_accuracy ? '±' . number_format($evidence->gps_accuracy, 1) . 'm' : '—' }}</span>
                            </div>
                            @if(isset($metadata['exif_gps_lat']) && $metadata['exif_gps_lat'])
                            <div class="metadata-item" style="grid-column: span 2;">
                                <span class="metadata-label">EXIF Embedded GPS</span>
                                <span class="metadata-value">{{ number_format($metadata['exif_gps_lat'], 6) }}, {{ number_format($metadata['exif_gps_lon'], 6) }}</span>
                            </div>
                            @endif
                        </div>
                        @if($evidence->hasGPS())
                        <!-- OpenStreetMap link -->
                        <a href="https://www.openstreetmap.org/?mlat={{ $evidence->latitude }}&mlon={{ $evidence->longitude }}#map=16/{{ $evidence->latitude }}/{{ $evidence->longitude }}" 
                           target="_blank" rel="noopener"
                           style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 1rem; padding: 0.7rem; background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.2); border-radius: 10px; color: #6ee7b7; font-weight: 700; font-size: 0.875rem; text-decoration: none; transition: all 0.2s;"
                           onmouseover="this.style.background='rgba(16,185,129,0.15)'" onmouseout="this.style.background='rgba(16,185,129,0.08)'">
                            <i class="ti ti-map-2"></i> View on Map
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Sidebar Content -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- Verification Badge -->
                    <div style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.1) 0%, rgba(8, 145, 178, 0.05) 100%); border: 1px solid rgba(6, 182, 212, 0.3); border-radius: 20px; padding: 1.5rem; text-align: center;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(34, 211, 238, 0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; border: 2px solid #06b6d4;">
                            <i class="ti ti-shield-check-filled" style="font-size: 1.75rem; color: #22d3ee;"></i>
                        </div>
                        <div style="font-size: 1rem; font-weight: 800; color: #fff; margin-bottom: 0.25rem;">Authentic Evidence</div>
                        <div style="font-size: 0.8125rem; color: #64748b;">Chain of custody verified</div>
                    </div>

                    <!-- Metadata Grid -->
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(71, 85, 105, 0.2); border-radius: 16px; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem;">
                        <!-- Custodian -->
                        <div>
                            <div style="font-size: 0.75rem; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Custodian</div>
                            <div style="display: flex; align-items: center; gap: 0.6rem;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: #06b6d4; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.75rem; flex-shrink: 0;">
                                    {{ strtoupper(substr($evidence->user->name, 0, 1)) }}
                                </div>
                                <div style="font-size: 0.9375rem; color: #e2e8f0; font-weight: 600;">{{ $evidence->user->name }}</div>
                            </div>
                        </div>

                        <!-- Capture Context -->
                        <div>
                            <div style="font-size: 0.75rem; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Capture Context</div>
                            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <i class="ti ti-calendar-event" style="color: #22d3ee; flex-shrink: 0;"></i>
                                    <div style="font-size: 0.875rem; color: #cbd5e1;">{{ $evidence->captured_at ? $evidence->captured_at->format('M d, Y') : $evidence->created_at->format('M d, Y') }}</div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <i class="ti ti-clock" style="color: #22d3ee; flex-shrink: 0;"></i>
                                    <div style="font-size: 0.875rem; color: #cbd5e1;">{{ $evidence->captured_at ? $evidence->captured_at->format('h:i:s A') : $evidence->created_at->format('h:i:s A') }}</div>
                                </div>
                                @if($evidence->hasGPS())
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <i class="ti ti-map-pin" style="color: #10b981; flex-shrink: 0;"></i>
                                    <div style="font-size: 0.8125rem; color: #6ee7b7; font-family: monospace;">{{ $evidence->formatted_gps }}</div>
                                </div>
                                @else
                                <div style="display: flex; align-items: center; gap: 0.6rem; opacity: 0.5;">
                                    <i class="ti ti-map-pin-off" style="color: #475569; flex-shrink: 0;"></i>
                                    <div style="font-size: 0.8125rem; color: #475569;">Location data unavailable</div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Device Info -->
                        @if($evidence->device_info)
                        <div>
                            <div style="font-size: 0.75rem; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Device</div>
                            <div style="display: flex; align-items: center; gap: 0.6rem;">
                                <i class="ti ti-device-mobile" style="color: #22d3ee; flex-shrink: 0;"></i>
                                <div style="font-size: 0.8125rem; color: #94a3b8; word-break: break-word;">{{ Str::limit($evidence->device_info, 80) }}</div>
                            </div>
                        </div>
                        @endif

                        <!-- Upload Date -->
                        <div>
                            <div style="font-size: 0.75rem; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Uploaded</div>
                            <div style="font-size: 0.875rem; color: #94a3b8;">{{ $evidence->created_at->format('M d, Y \a\t h:i A') }}</div>
                        </div>

                        <!-- Download -->
                        <div style="margin-top: 0.5rem;">
                            <a href="{{ $evidence->file_url }}" download 
                               style="display: flex; align-items: center; justify-content: center; gap: 0.6rem; width: 100%; padding: 0.8rem; background: rgba(34, 211, 238, 0.1); border: 1px solid rgba(34, 211, 238, 0.3); border-radius: 12px; color: #22d3ee; font-weight: 700; text-decoration: none; transition: all 0.2s; font-size: 0.875rem;"
                               onmouseover="this.style.background='rgba(34, 211, 238, 0.2)'" onmouseout="this.style.background='rgba(34, 211, 238, 0.1)'">
                                <i class="ti ti-download"></i> Download Original
                            </a>
                        </div>
                    </div>

                    <!-- Privacy Shield -->
                    <div class="privacy-shield">
                        <i class="ti ti-shield-lock" style="font-size: 1.1rem;"></i>
                        <span style="font-size: 0.8125rem;">This evidence is protected by AES-256 encryption with immutable chain of custody.</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Responsive override for evidence detail grid -->
    <style>
        @media (max-width: 768px) {
            .evidence-detail-grid {
                grid-template-columns: 1fr !important;
            }
        }
        @media (max-width: 480px) {
            .metadata-panel {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-app-layout>
