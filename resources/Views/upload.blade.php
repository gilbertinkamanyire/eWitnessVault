<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ti ti-cloud-upload" style="font-size: 1.5rem; background: linear-gradient(135deg, #06b6d4, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #e2e8f0; font-family: 'Outfit', sans-serif;">Upload Evidence</h2>
            </div>
            <a href="{{ route('dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.875rem; color: #64748b; text-decoration: none; transition: color 0.2s; font-family: 'Outfit', sans-serif;"
               onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#64748b'">
                <i class="ti ti-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div style="padding: 2rem 1rem; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 720px; margin: 0 auto;">

            <!-- Success Message -->
            @if(session('success'))
                <div style="margin-bottom: 1.5rem; padding: 1rem 1.25rem; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; display: flex; align-items: center; gap: 0.75rem; color: #6ee7b7;">
                    <i class="ti ti-circle-check" style="font-size: 1.25rem; flex-shrink: 0;"></i>
                    <div>
                        <div style="font-weight: 700; margin-bottom: 0.1rem;">Success!</div>
                        <div style="font-size: 0.875rem; opacity: 0.85;">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            <!-- Data Privacy & Encryption Shield -->
            <div class="encryption-indicator" style="margin-bottom: 1.5rem;">
                <div class="encryption-icon">
                    <i class="ti ti-shield-lock"></i>
                </div>
                <div class="encryption-details">
                    <div class="encryption-title">End-to-End Evidence Protection</div>
                    <div class="encryption-desc">AES-256 encryption · SHA-256 integrity hash · GPS & timestamp verified · Court-admissible chain of custody</div>
                </div>
            </div>

            <!-- Upload Card -->
            <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(34, 211, 238, 0.15); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">

                <!-- Card Header -->
                <div style="padding: 1.5rem 2rem; border-bottom: 1px solid rgba(71,85,105,0.3); display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(6,182,212,0.15); border: 1px solid rgba(6,182,212,0.3); display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-file-plus" style="font-size: 1.25rem; color: #22d3ee;"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 1rem; font-weight: 700; color: #e2e8f0;">New Evidence File</div>
                        <div style="font-size: 0.8125rem; color: #475569;">All uploads are encrypted, timestamped, and GPS-verified</div>
                    </div>
                </div>

                <!-- Form -->
                <div style="padding: 2rem;">
                    <form method="POST" action="{{ route('evidence.store') }}" enctype="multipart/form-data" id="evidence-form" style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @csrf

                        <!-- Title -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label for="title" style="font-size: 0.8125rem; font-weight: 600; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="ti ti-tag" style="color: #22d3ee;"></i>
                                Evidence Title <span style="color: #f87171;">*</span>
                            </label>
                            <input
                                type="text" id="title" name="title"
                                value="{{ old('title') }}" required
                                placeholder="Enter a descriptive title for this evidence"
                                style="width: 100%; padding: 0.75rem 1rem; background: rgba(30,41,59,0.6); border: 1.5px solid rgba(71,85,105,0.4); border-radius: 10px; font-size: 0.9rem; font-family: 'Outfit', sans-serif; color: #e2e8f0; transition: all 0.25s; outline: none;"
                                onfocus="this.style.borderColor='#06b6d4'; this.style.boxShadow='0 0 0 3px rgba(6,182,212,0.15)';"
                                onblur="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.boxShadow='none';"
                            >
                            @error('title')
                                <p style="color: #f87171; font-size: 0.8125rem; display: flex; align-items: center; gap: 0.3rem;">
                                    <i class="ti ti-alert-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label for="description" style="font-size: 0.8125rem; font-weight: 600; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="ti ti-align-left" style="color: #22d3ee;"></i>
                                Description <span style="color: #475569; font-weight: 400;">(Optional)</span>
                            </label>
                            <textarea
                                id="description" name="description" rows="3"
                                placeholder="Provide additional context — case number, location details, what the evidence shows..."
                                style="width: 100%; padding: 0.75rem 1rem; background: rgba(30,41,59,0.6); border: 1.5px solid rgba(71,85,105,0.4); border-radius: 10px; font-size: 0.9rem; font-family: 'Outfit', sans-serif; color: #e2e8f0; transition: all 0.25s; outline: none; resize: vertical; min-height: 80px;"
                                onfocus="this.style.borderColor='#06b6d4'; this.style.boxShadow='0 0 0 3px rgba(6,182,212,0.15)';"
                                onblur="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.boxShadow='none';"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p style="color: #f87171; font-size: 0.8125rem; display: flex; align-items: center; gap: 0.3rem;">
                                    <i class="ti ti-alert-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- GPS and Timestamp Metadata (Hidden) -->
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <input type="hidden" name="altitude" id="altitude">
                        <input type="hidden" name="accuracy" id="accuracy">
                        <input type="hidden" name="captured_at" id="captured_at">
                        <input type="hidden" name="device_info" id="device_info">
                        <input type="hidden" name="exif_gps_lat" id="exif_gps_lat">
                        <input type="hidden" name="exif_gps_lon" id="exif_gps_lon">
                        <input type="hidden" name="exif_datetime" id="exif_datetime">

                        <!-- ═══════════════════════════════════════════ -->
                        <!-- GPS & TIMESTAMP VERIFICATION PANEL         -->
                        <!-- ═══════════════════════════════════════════ -->
                        <div style="background: rgba(0,0,0,0.2); border: 1px solid rgba(71,85,105,0.2); border-radius: 14px; overflow: hidden;">
                            <div style="padding: 1rem 1.25rem; border-bottom: 1px solid rgba(71,85,105,0.15); display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <i class="ti ti-map-pin-check" style="color: #22d3ee; font-size: 1.1rem;"></i>
                                    <span style="font-size: 0.875rem; font-weight: 700; color: #e2e8f0;">Location & Timestamp Verification</span>
                                </div>
                                <div id="gps-status-badge" class="gps-badge gps-pending">
                                    <span class="gps-badge-dot"></span>
                                    <span id="gps-indicator-text">Acquiring...</span>
                                </div>
                            </div>
                            <div class="metadata-panel" id="metadata-panel">
                                <div class="metadata-item">
                                    <span class="metadata-label"><i class="ti ti-map-pin" style="font-size: 0.7rem;"></i> Latitude</span>
                                    <span class="metadata-value" id="display-lat">Acquiring...</span>
                                </div>
                                <div class="metadata-item">
                                    <span class="metadata-label"><i class="ti ti-map-pin" style="font-size: 0.7rem;"></i> Longitude</span>
                                    <span class="metadata-value" id="display-lon">Acquiring...</span>
                                </div>
                                <div class="metadata-item">
                                    <span class="metadata-label"><i class="ti ti-mountain" style="font-size: 0.7rem;"></i> Altitude</span>
                                    <span class="metadata-value" id="display-alt">—</span>
                                </div>
                                <div class="metadata-item">
                                    <span class="metadata-label"><i class="ti ti-circle-dot" style="font-size: 0.7rem;"></i> Accuracy</span>
                                    <span class="metadata-value" id="display-acc">—</span>
                                </div>
                                <div class="metadata-item" style="grid-column: span 2;">
                                    <span class="metadata-label"><i class="ti ti-clock" style="font-size: 0.7rem;"></i> Capture Timestamp (UTC)</span>
                                    <span class="metadata-value verified" id="display-time">—</span>
                                </div>
                                <div class="metadata-item" style="grid-column: span 2;">
                                    <span class="metadata-label"><i class="ti ti-device-mobile" style="font-size: 0.7rem;"></i> Device / Platform</span>
                                    <span class="metadata-value" id="display-device">Detecting...</span>
                                </div>
                            </div>
                        </div>

                        <!-- ═══════════════════════════════════════════ -->
                        <!-- DIGITAL CAPTURE MODE (Camera)              -->
                        <!-- ═══════════════════════════════════════════ -->
                        <div style="background: rgba(6, 182, 212, 0.05); border: 1px solid rgba(6, 182, 212, 0.15); border-radius: 12px; padding: 1.25rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 211, 238, 0.1); border: 1px solid rgba(34, 211, 238, 0.2); display: flex; align-items: center; justify-content: center;">
                                        <i class="ti ti-camera" style="color: #22d3ee;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.875rem; font-weight: 700; color: #e2e8f0;">Digital Capture Mode</div>
                                        <div style="font-size: 0.75rem; color: #64748b;">Take photos or record video with embedded GPS + timestamp</div>
                                    </div>
                                </div>
                                <button type="button" id="toggle-capture" onclick="toggleCaptureMode()" style="padding: 0.45rem 1rem; background: rgba(30, 41, 59, 0.6); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 8px; color: #22d3ee; font-size: 0.75rem; font-weight: 700; cursor: pointer; transition: all 0.2s; font-family: 'Outfit', sans-serif;">
                                    Enable Capture
                                </button>
                            </div>

                            <!-- Capture Interface (Hidden by default) -->
                            <div id="capture-interface" style="display: none; flex-direction: column; gap: 1rem;">
                                <div style="position: relative; border-radius: 12px; overflow: hidden; background: #000; aspect-ratio: 4/3; border: 1px solid rgba(34, 211, 238, 0.2);">
                                    <video id="capture-video" autoplay playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                                    <canvas id="capture-canvas" style="display: none;"></canvas>
                                    
                                    <!-- GPS/Time Watermark Overlay on camera -->
                                    <div id="camera-overlay" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%); padding: 1.5rem 1rem 1rem;">
                                        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                                            <div>
                                                <div style="font-size: 0.6rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 0.25rem;">
                                                    <i class="ti ti-shield-check" style="font-size: 0.6rem;"></i> VERIFIED CAPTURE
                                                </div>
                                                <div id="overlay-gps" style="font-size: 0.8rem; color: #fff; font-family: monospace;">Awaiting GPS...</div>
                                                <div id="overlay-time" style="font-size: 0.75rem; color: #22d3ee; font-family: monospace;">—</div>
                                            </div>
                                            <div style="text-align: right;">
                                                <div id="overlay-accuracy" style="font-size: 0.65rem; color: #6ee7b7; font-family: monospace;">—</div>
                                                <div style="font-size: 0.6rem; color: #475569; font-family: monospace;" id="overlay-device">—</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recording indicator -->
                                    <div id="recording-indicator" style="display: none; position: absolute; top: 1rem; right: 1rem; padding: 0.3rem 0.8rem; background: rgba(239,68,68,0.9); border-radius: 50px; display: none; align-items: center; gap: 0.4rem; animation: blink-dot 1s infinite;">
                                        <span style="width: 8px; height: 8px; background: #fff; border-radius: 50%; display: inline-block;"></span>
                                        <span style="font-size: 0.7rem; color: #fff; font-weight: 700; font-family: monospace;">REC</span>
                                    </div>
                                </div>

                                <!-- Camera Controls -->
                                <div style="display: flex; gap: 0.75rem;">
                                    <button type="button" onclick="switchCamera()" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: rgba(30,41,59,0.6); border: 1px solid rgba(71,85,105,0.4); border-radius: 12px; color: #94a3b8; cursor: pointer; transition: all 0.2s; flex-shrink: 0;" title="Switch Camera">
                                        <i class="ti ti-camera-rotate" style="font-size: 1.25rem;"></i>
                                    </button>
                                    <button type="button" onclick="takePhoto()" style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.8rem; background: #06b6d4; border: none; border-radius: 10px; color: white; font-weight: 700; cursor: pointer; font-family: 'Outfit', sans-serif; font-size: 0.875rem;">
                                        <i class="ti ti-photo"></i> Take Photo
                                    </button>
                                    <button type="button" id="record-btn" onclick="toggleRecording()" style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.8rem; background: rgba(239, 68, 68, 0.1); border: 1.5px solid rgba(239, 68, 68, 0.3); border-radius: 10px; color: #f87171; font-weight: 700; cursor: pointer; font-family: 'Outfit', sans-serif; font-size: 0.875rem;">
                                        <i class="ti ti-video" id="record-icon"></i> <span id="record-text">Record</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ═══════════════════════════════════════════ -->
                        <!-- FILE UPLOAD DROP ZONE                      -->
                        <!-- ═══════════════════════════════════════════ -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label style="font-size: 0.8125rem; font-weight: 600; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="ti ti-paperclip" style="color: #22d3ee;"></i>
                                Evidence File <span style="color: #f87171;">*</span>
                            </label>

                            <div id="drop-zone"
                                 style="border: 2px dashed rgba(71,85,105,0.5); border-radius: 14px; padding: 2.5rem 1.5rem; text-align: center; cursor: pointer; transition: all 0.3s; background: rgba(30,41,59,0.3); position: relative;"
                                 onclick="document.getElementById('file').click()"
                                 ondragover="event.preventDefault(); this.style.borderColor='#06b6d4'; this.style.background='rgba(6,182,212,0.08)';"
                                 ondragleave="this.style.borderColor='rgba(71,85,105,0.5)'; this.style.background='rgba(30,41,59,0.3)';"
                                 ondrop="handleDrop(event)">
                                <i class="ti ti-cloud-upload" id="drop-icon" style="font-size: 3.5rem; color: #334155; display: block; margin-bottom: 1rem; transition: all 0.3s;"></i>
                                <div style="font-size: 1rem; font-weight: 600; color: #64748b; margin-bottom: 0.4rem;">
                                    Drop your file here, or <span style="color: #22d3ee; cursor: pointer;">browse</span>
                                </div>
                                <div style="font-size: 0.8125rem; color: #334155;">
                                    PNG, JPG, PDF, DOC, DOCX, MP4 — up to 10MB
                                </div>
                                <div id="preview-container" style="display: none; margin-top: 1rem;">
                                    <div id="file-name" style="font-size: 0.875rem; font-weight: 600; color: #22d3ee; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                        <i class="ti ti-file-check"></i>
                                        <span id="file-name-text"></span>
                                    </div>
                                    <img id="image-preview" style="display: none; max-width: 100%; max-height: 200px; margin: 1rem auto; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);">
                                    <!-- EXIF GPS data extracted from uploaded image -->
                                    <div id="exif-data-panel" style="display: none; margin-top: 0.75rem; padding: 0.75rem 1rem; background: rgba(16,185,129,0.06); border: 1px solid rgba(16,185,129,0.15); border-radius: 10px; text-align: left;">
                                        <div style="font-size: 0.6875rem; font-weight: 700; color: #6ee7b7; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem;">
                                            <i class="ti ti-photo-check" style="font-size: 0.8rem;"></i> EXIF Metadata Extracted
                                        </div>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.4rem;">
                                            <div style="font-size: 0.75rem; color: #94a3b8;"><strong style="color: #cbd5e1;">GPS:</strong> <span id="exif-display-gps">—</span></div>
                                            <div style="font-size: 0.75rem; color: #94a3b8;"><strong style="color: #cbd5e1;">Date:</strong> <span id="exif-display-date">—</span></div>
                                            <div style="font-size: 0.75rem; color: #94a3b8;"><strong style="color: #cbd5e1;">Camera:</strong> <span id="exif-display-camera">—</span></div>
                                            <div style="font-size: 0.75rem; color: #94a3b8;"><strong style="color: #cbd5e1;">Resolution:</strong> <span id="exif-display-res">—</span></div>
                                        </div>
                                    </div>
                                </div>
                                <input
                                    id="file" name="file" type="file" required
                                    accept="image/*,video/*,application/pdf,.doc,.docx"
                                    style="display: none;"
                                    onchange="handleFileSelected(this)"
                                >
                            </div>
                            @error('file')
                                <p style="color: #f87171; font-size: 0.8125rem; display: flex; align-items: center; gap: 0.3rem;">
                                    <i class="ti ti-alert-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- ═══════════════════════════════════════════ -->
                        <!-- DATA PRIVACY & SECURITY INFORMATION        -->
                        <!-- ═══════════════════════════════════════════ -->
                        <div style="padding: 1rem 1.25rem; background: rgba(6,182,212,0.06); border: 1px solid rgba(6,182,212,0.15); border-radius: 12px;">
                            <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                                <i class="ti ti-shield-check-filled" style="font-size: 1.1rem; color: #10b981; flex-shrink: 0; margin-top: 0.1rem;"></i>
                                <div>
                                    <div style="font-size: 0.875rem; font-weight: 700; color: #6ee7b7; margin-bottom: 0.5rem;">Data Privacy & Chain of Custody</div>
                                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.3rem;">
                                        <li style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ti ti-point-filled" style="color: #10b981; font-size: 0.5rem;"></i> SHA-256 cryptographic hash for tamper detection
                                        </li>
                                        <li style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ti ti-point-filled" style="color: #10b981; font-size: 0.5rem;"></i> AES-256 encrypted storage at rest
                                        </li>
                                        <li style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ti ti-point-filled" style="color: #10b981; font-size: 0.5rem;"></i> GPS coordinates & altitude embedded on every capture
                                        </li>
                                        <li style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ti ti-point-filled" style="color: #10b981; font-size: 0.5rem;"></i> ISO 8601 UTC timestamp on every submission
                                        </li>
                                        <li style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ti ti-point-filled" style="color: #10b981; font-size: 0.5rem;"></i> EXIF metadata extracted from uploaded photos/videos
                                        </li>
                                        <li style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ti ti-point-filled" style="color: #10b981; font-size: 0.5rem;"></i> Device fingerprint recorded for audit trail
                                        </li>
                                        <li style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ti ti-point-filled" style="color: #10b981; font-size: 0.5rem;"></i> Role-based access control (RBAC) enforcement
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 1rem; padding-top: 0.5rem; border-top: 1px solid rgba(71,85,105,0.2);">
                            <a href="{{ route('dashboard') }}"
                               style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.7rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #64748b; background: rgba(30,41,59,0.5); border: 1px solid rgba(71,85,105,0.3); border-radius: 10px; text-decoration: none; transition: all 0.2s; font-family: 'Outfit', sans-serif;"
                               onmouseover="this.style.color='#e2e8f0'; this.style.borderColor='rgba(71,85,105,0.6)';"
                               onmouseout="this.style.color='#64748b'; this.style.borderColor='rgba(71,85,105,0.3)';">
                                <i class="ti ti-x"></i> Cancel
                            </a>
                            <button type="submit" id="submit-btn"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.7rem 2rem; font-size: 0.9375rem; font-weight: 700; color: white; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); border: none; border-radius: 10px; cursor: pointer; transition: all 0.25s; font-family: 'Outfit', sans-serif; box-shadow: 0 4px 20px rgba(6,182,212,0.3); position: relative; overflow: hidden;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(6,182,212,0.5)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(6,182,212,0.3)';">
                                <i class="ti ti-shield-check"></i>
                                Upload to Secure Vault
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ═══════════════════════════════════════════════════════════
        // CORE VARIABLES
        // ═══════════════════════════════════════════════════════════
        let stream = null;
        let mediaRecorder = null;
        let recordedChunks = [];
        let isRecording = false;
        let currentFacingMode = 'environment';
        let gpsWatchId = null;
        let timestampInterval = null;
        let currentLat = null;
        let currentLon = null;

        // ═══════════════════════════════════════════════════════════
        // AUTO-INITIALIZE: GPS + Timestamp + Device Info
        // ═══════════════════════════════════════════════════════════
        document.addEventListener('DOMContentLoaded', () => {
            // Start GPS immediately
            startGPSTracking();

            // Start live timestamp
            updateTimestamp();
            timestampInterval = setInterval(updateTimestamp, 1000);

            // Detect device info
            detectDeviceInfo();

            // Auto-set captured_at on form submit
            document.getElementById('evidence-form').addEventListener('submit', function(e) {
                const now = new Date();
                document.getElementById('captured_at').value = now.toISOString();

                // Show loading state
                const btn = document.getElementById('submit-btn');
                btn.innerHTML = '<i class="ti ti-loader" style="animation: spin 1s linear infinite;"></i> Encrypting & Uploading...';
                btn.style.pointerEvents = 'none';
                btn.style.opacity = '0.75';
            });
        });

        // ═══════════════════════════════════════════════════════════
        // GPS TRACKING (Continuous, High Accuracy)
        // ═══════════════════════════════════════════════════════════
        function startGPSTracking() {
            // Try Capacitor first (native app)
            if (window.isNative && window.Capacitor && window.Capacitor.Plugins.Geolocation) {
                startCapacitorGPS();
            } else {
                startBrowserGPS();
            }
        }

        function startCapacitorGPS() {
            const Geolocation = window.Capacitor.Plugins.Geolocation;
            Geolocation.watchPosition(
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 },
                (pos, err) => {
                    if (pos) {
                        updateGPSFields(pos.coords);
                    } else if (err) {
                        setGPSError('Native GPS error');
                    }
                }
            ).catch(() => {
                // Fallback to browser
                startBrowserGPS();
            });
        }

        function startBrowserGPS() {
            if (!navigator.geolocation) {
                setGPSError('GPS not supported');
                return;
            }

            gpsWatchId = navigator.geolocation.watchPosition(
                (pos) => updateGPSFields(pos.coords),
                (err) => {
                    switch(err.code) {
                        case 1: setGPSError('GPS permission denied'); break;
                        case 2: setGPSError('GPS unavailable'); break;
                        case 3: setGPSError('GPS timeout — retrying...'); break;
                    }
                },
                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
            );
        }

        function updateGPSFields(coords) {
            currentLat = coords.latitude;
            currentLon = coords.longitude;

            // Update hidden form fields
            document.getElementById('latitude').value = coords.latitude;
            document.getElementById('longitude').value = coords.longitude;
            document.getElementById('altitude').value = coords.altitude || '';
            document.getElementById('accuracy').value = coords.accuracy || '';

            // Update display panel
            document.getElementById('display-lat').textContent = coords.latitude.toFixed(8);
            document.getElementById('display-lat').classList.add('verified');
            document.getElementById('display-lon').textContent = coords.longitude.toFixed(8);
            document.getElementById('display-lon').classList.add('verified');
            document.getElementById('display-alt').textContent = coords.altitude ? `${coords.altitude.toFixed(1)}m` : 'N/A';
            document.getElementById('display-acc').textContent = coords.accuracy ? `±${coords.accuracy.toFixed(1)}m` : '—';

            // Update camera overlay
            document.getElementById('overlay-gps').textContent = `${coords.latitude.toFixed(6)}, ${coords.longitude.toFixed(6)}`;
            document.getElementById('overlay-accuracy').textContent = coords.accuracy ? `±${coords.accuracy.toFixed(0)}m accuracy` : '';

            // Update GPS badge
            const badge = document.getElementById('gps-status-badge');
            badge.className = 'gps-badge';
            document.getElementById('gps-indicator-text').textContent = 'Signal Verified';
        }

        function setGPSError(msg) {
            const badge = document.getElementById('gps-status-badge');
            badge.className = 'gps-badge gps-denied';
            document.getElementById('gps-indicator-text').textContent = msg;
            document.getElementById('display-lat').textContent = 'Unavailable';
            document.getElementById('display-lon').textContent = 'Unavailable';
        }

        // ═══════════════════════════════════════════════════════════
        // LIVE TIMESTAMP
        // ═══════════════════════════════════════════════════════════
        function updateTimestamp() {
            const now = new Date();
            const utcStr = now.toISOString().replace('T', ' ').substring(0, 23) + ' UTC';
            const localStr = now.toLocaleString();

            document.getElementById('display-time').textContent = utcStr;
            document.getElementById('overlay-time').textContent = localStr;
        }

        // ═══════════════════════════════════════════════════════════
        // DEVICE INFO
        // ═══════════════════════════════════════════════════════════
        function detectDeviceInfo() {
            const ua = navigator.userAgent;
            let deviceStr = 'Unknown Device';

            if (window.isNative) {
                deviceStr = 'eWitnessVault Native App';
            } else if (/Android/i.test(ua)) {
                const match = ua.match(/Android\s([0-9.]+)/);
                deviceStr = `Android ${match ? match[1] : ''}`;
            } else if (/iPhone|iPad|iPod/i.test(ua)) {
                const match = ua.match(/OS\s([0-9_]+)/);
                deviceStr = `iOS ${match ? match[1].replace(/_/g, '.') : ''}`;
            } else if (/Windows/i.test(ua)) {
                deviceStr = 'Windows Desktop';
            } else if (/Mac/i.test(ua)) {
                deviceStr = 'macOS Desktop';
            } else if (/Linux/i.test(ua)) {
                deviceStr = 'Linux Desktop';
            }

            if (window.matchMedia('(display-mode: standalone)').matches) {
                deviceStr += ' (PWA)';
            }

            document.getElementById('display-device').textContent = deviceStr;
            document.getElementById('overlay-device').textContent = deviceStr;
            document.getElementById('device_info').value = deviceStr + ' | ' + navigator.userAgent.substring(0, 150);
        }

        // ═══════════════════════════════════════════════════════════
        // FILE HANDLING & EXIF EXTRACTION
        // ═══════════════════════════════════════════════════════════
        function handleFileSelected(input) {
            const file = input.files[0];
            if (!file) return;

            updateFilePreview(file);

            // Extract EXIF from images
            if (file.type.startsWith('image/')) {
                extractEXIF(file);
            }

            // Extract metadata from video
            if (file.type.startsWith('video/')) {
                extractVideoMeta(file);
            }
        }

        function updateFilePreview(file) {
            const previewContainer = document.getElementById('preview-container');
            const nameText = document.getElementById('file-name-text');
            const icon = document.getElementById('drop-icon');
            const imgPreview = document.getElementById('image-preview');

            nameText.textContent = file.name + ' (' + formatFileSize(file.size) + ')';
            previewContainer.style.display = 'block';
            icon.style.color = '#22d3ee';
            icon.className = 'ti ti-file-check';

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imgPreview.style.display = 'none';
            }
        }

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        }

        // ═══════════════════════════════════════════════════════════
        // EXIF EXTRACTION (GPS from uploaded photos)
        // ═══════════════════════════════════════════════════════════
        function extractEXIF(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const view = new DataView(e.target.result);
                const exifPanel = document.getElementById('exif-data-panel');
                
                // Basic JPEG EXIF parser
                if (view.getUint16(0) !== 0xFFD8) {
                    // Not a JPEG, skip EXIF
                    return;
                }

                let offset = 2;
                while (offset < view.byteLength) {
                    if (view.getUint16(offset) === 0xFFE1) {
                        // Found EXIF marker
                        const exifData = parseBasicEXIF(view, offset + 4);
                        if (exifData) {
                            displayEXIFData(exifData);
                        }
                        return;
                    }
                    // Move to next marker
                    const size = view.getUint16(offset + 2);
                    offset += size + 2;
                    if (offset >= view.byteLength - 2) break;
                }

                // Show panel even without EXIF data
                exifPanel.style.display = 'block';
                document.getElementById('exif-display-gps').textContent = 'Not embedded in file';
                document.getElementById('exif-display-date').textContent = new Date(file.lastModified).toLocaleString();
                document.getElementById('exif-display-camera').textContent = '—';
                document.getElementById('exif-display-res').textContent = '—';

                // Use file's last modified date as fallback timestamp
                if (!document.getElementById('exif_datetime').value) {
                    document.getElementById('exif_datetime').value = new Date(file.lastModified).toISOString();
                }
            };
            reader.readAsArrayBuffer(file.slice(0, 128 * 1024)); // Read first 128KB for EXIF
        }

        function parseBasicEXIF(view, offset) {
            try {
                // Check for "Exif" header
                const exifStr = String.fromCharCode(view.getUint8(offset), view.getUint8(offset+1), view.getUint8(offset+2), view.getUint8(offset+3));
                if (exifStr !== 'Exif') return null;

                const tiffOffset = offset + 6;
                const littleEndian = view.getUint16(tiffOffset) === 0x4949;

                // Read IFD0 entries
                const ifdOffset = tiffOffset + view.getUint32(tiffOffset + 4, littleEndian);
                const entries = view.getUint16(ifdOffset, littleEndian);

                let gpsIFDPointer = null;
                let dateTimeOriginal = null;
                let make = null;
                let model = null;
                let width = null;
                let height = null;

                for (let i = 0; i < entries && i < 50; i++) {
                    const entryOffset = ifdOffset + 2 + (i * 12);
                    if (entryOffset + 12 > view.byteLength) break;
                    
                    const tag = view.getUint16(entryOffset, littleEndian);

                    if (tag === 0x8825) { // GPSInfoIFDPointer
                        gpsIFDPointer = tiffOffset + view.getUint32(entryOffset + 8, littleEndian);
                    }
                    if (tag === 0x0132 || tag === 0x9003) { // DateTime / DateTimeOriginal
                        const strOffset = tiffOffset + view.getUint32(entryOffset + 8, littleEndian);
                        dateTimeOriginal = readASCII(view, strOffset, 19);
                    }
                    if (tag === 0x010F) { // Make
                        const count = view.getUint32(entryOffset + 4, littleEndian);
                        if (count <= 4) {
                            make = readASCII(view, entryOffset + 8, count);
                        } else {
                            const strOff = tiffOffset + view.getUint32(entryOffset + 8, littleEndian);
                            make = readASCII(view, strOff, Math.min(count, 30));
                        }
                    }
                    if (tag === 0x0110) { // Model
                        const count = view.getUint32(entryOffset + 4, littleEndian);
                        if (count <= 4) {
                            model = readASCII(view, entryOffset + 8, count);
                        } else {
                            const strOff = tiffOffset + view.getUint32(entryOffset + 8, littleEndian);
                            model = readASCII(view, strOff, Math.min(count, 40));
                        }
                    }
                    if (tag === 0xA002) width = view.getUint32(entryOffset + 8, littleEndian); // PixelXDimension
                    if (tag === 0xA003) height = view.getUint32(entryOffset + 8, littleEndian); // PixelYDimension
                }

                // Parse GPS IFD
                let gpsLat = null, gpsLon = null;
                if (gpsIFDPointer && gpsIFDPointer + 4 < view.byteLength) {
                    const gpsResult = parseGPSIFD(view, gpsIFDPointer, tiffOffset, littleEndian);
                    if (gpsResult) {
                        gpsLat = gpsResult.lat;
                        gpsLon = gpsResult.lon;
                    }
                }

                return {
                    gpsLat, gpsLon,
                    dateTime: dateTimeOriginal,
                    camera: [make, model].filter(Boolean).join(' ').trim() || null,
                    resolution: (width && height) ? `${width}×${height}` : null
                };
            } catch (e) {
                console.warn('EXIF parsing error:', e);
                return null;
            }
        }

        function parseGPSIFD(view, ifdOffset, tiffOffset, littleEndian) {
            try {
                if (ifdOffset + 2 > view.byteLength) return null;
                const entries = view.getUint16(ifdOffset, littleEndian);
                let latRef = 'N', lonRef = 'E';
                let latDeg = null, lonDeg = null;

                for (let i = 0; i < entries && i < 20; i++) {
                    const entryOffset = ifdOffset + 2 + (i * 12);
                    if (entryOffset + 12 > view.byteLength) break;
                    
                    const tag = view.getUint16(entryOffset, littleEndian);

                    if (tag === 1) { // GPSLatitudeRef
                        latRef = String.fromCharCode(view.getUint8(entryOffset + 8));
                    }
                    if (tag === 3) { // GPSLongitudeRef
                        lonRef = String.fromCharCode(view.getUint8(entryOffset + 8));
                    }
                    if (tag === 2) { // GPSLatitude
                        const valOffset = tiffOffset + view.getUint32(entryOffset + 8, littleEndian);
                        latDeg = readGPSCoord(view, valOffset, littleEndian);
                    }
                    if (tag === 4) { // GPSLongitude
                        const valOffset = tiffOffset + view.getUint32(entryOffset + 8, littleEndian);
                        lonDeg = readGPSCoord(view, valOffset, littleEndian);
                    }
                }

                if (latDeg !== null && lonDeg !== null) {
                    return {
                        lat: latRef === 'S' ? -latDeg : latDeg,
                        lon: lonRef === 'W' ? -lonDeg : lonDeg
                    };
                }
                return null;
            } catch (e) {
                return null;
            }
        }

        function readGPSCoord(view, offset, littleEndian) {
            try {
                if (offset + 24 > view.byteLength) return null;
                const deg = view.getUint32(offset, littleEndian) / view.getUint32(offset + 4, littleEndian);
                const min = view.getUint32(offset + 8, littleEndian) / view.getUint32(offset + 12, littleEndian);
                const sec = view.getUint32(offset + 16, littleEndian) / view.getUint32(offset + 20, littleEndian);
                return deg + (min / 60) + (sec / 3600);
            } catch (e) {
                return null;
            }
        }

        function readASCII(view, offset, length) {
            try {
                let str = '';
                for (let i = 0; i < length && (offset + i) < view.byteLength; i++) {
                    const c = view.getUint8(offset + i);
                    if (c === 0) break;
                    str += String.fromCharCode(c);
                }
                return str.trim();
            } catch (e) {
                return '';
            }
        }

        function displayEXIFData(exif) {
            const panel = document.getElementById('exif-data-panel');
            panel.style.display = 'block';

            if (exif.gpsLat !== null && exif.gpsLon !== null) {
                document.getElementById('exif-display-gps').textContent = `${exif.gpsLat.toFixed(6)}, ${exif.gpsLon.toFixed(6)}`;
                document.getElementById('exif_gps_lat').value = exif.gpsLat;
                document.getElementById('exif_gps_lon').value = exif.gpsLon;

                // If we don't have live GPS, use EXIF GPS
                if (!currentLat) {
                    updateGPSFields({
                        latitude: exif.gpsLat,
                        longitude: exif.gpsLon,
                        altitude: null,
                        accuracy: null
                    });
                }
            } else {
                document.getElementById('exif-display-gps').textContent = 'Not embedded';
            }

            document.getElementById('exif-display-date').textContent = exif.dateTime || '—';
            document.getElementById('exif-display-camera').textContent = exif.camera || '—';
            document.getElementById('exif-display-res').textContent = exif.resolution || '—';

            if (exif.dateTime) {
                document.getElementById('exif_datetime').value = exif.dateTime;
            }
        }

        function extractVideoMeta(file) {
            const panel = document.getElementById('exif-data-panel');
            panel.style.display = 'block';
            document.getElementById('exif-display-gps').textContent = 'Using device GPS';
            document.getElementById('exif-display-date').textContent = new Date(file.lastModified).toLocaleString();
            document.getElementById('exif-display-camera').textContent = 'Video file';
            document.getElementById('exif-display-res').textContent = formatFileSize(file.size);
        }

        // ═══════════════════════════════════════════════════════════
        // CAMERA CAPTURE
        // ═══════════════════════════════════════════════════════════
        async function toggleCaptureMode() {
            const container = document.getElementById('capture-interface');
            const video = document.getElementById('capture-video');
            const btn = document.getElementById('toggle-capture');

            if (container.style.display === 'none') {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ 
                        video: { 
                            facingMode: currentFacingMode,
                            width: { ideal: 1920 },
                            height: { ideal: 1080 }
                        }, 
                        audio: true 
                    });
                    video.srcObject = stream;
                    container.style.display = 'flex';
                    btn.textContent = 'Disable Capture';
                    btn.style.borderColor = '#f87171';
                    btn.style.color = '#f87171';
                } catch (err) {
                    alert('Camera access denied or unavailable: ' + err.message);
                }
            } else {
                stopCapture();
                container.style.display = 'none';
                btn.textContent = 'Enable Capture';
                btn.style.borderColor = 'rgba(71,85,105,0.4)';
                btn.style.color = '#22d3ee';
            }
        }

        async function switchCamera() {
            currentFacingMode = currentFacingMode === 'environment' ? 'user' : 'environment';
            if (stream) {
                stopCapture();
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ 
                        video: { 
                            facingMode: currentFacingMode,
                            width: { ideal: 1920 },
                            height: { ideal: 1080 }
                        },
                        audio: true 
                    });
                    document.getElementById('capture-video').srcObject = stream;
                } catch (err) {
                    alert('Could not switch camera: ' + err.message);
                }
            }
        }

        function stopCapture() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
        }

        function takePhoto() {
            const video = document.getElementById('capture-video');
            const canvas = document.getElementById('capture-canvas');
            const fileInput = document.getElementById('file');
            
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0);

            // Burn GPS + timestamp watermark into the image
            const now = new Date();
            const watermark = `eWitnessVault | ${now.toISOString()} | GPS: ${currentLat ? currentLat.toFixed(6) + ', ' + currentLon.toFixed(6) : 'N/A'}`;
            
            ctx.fillStyle = 'rgba(0,0,0,0.5)';
            ctx.fillRect(0, canvas.height - 30, canvas.width, 30);
            ctx.fillStyle = '#22d3ee';
            ctx.font = '12px monospace';
            ctx.fillText(watermark, 8, canvas.height - 10);
            
            canvas.toBlob((blob) => {
                const timestamp = now.getTime();
                const file = new File([blob], `ewitness_capture_${timestamp}.jpg`, { type: 'image/jpeg' });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                
                handleFileSelected(fileInput);
                
                // Visual flash feedback
                video.style.opacity = '0.3';
                setTimeout(() => video.style.opacity = '1', 150);

                // Haptic feedback
                if (typeof hapticFeedback === 'function') hapticFeedback('SUCCESS');
            }, 'image/jpeg', 0.95);
        }

        function toggleRecording() {
            const btn = document.getElementById('record-btn');
            const icon = document.getElementById('record-icon');
            const text = document.getElementById('record-text');
            const fileInput = document.getElementById('file');
            const indicator = document.getElementById('recording-indicator');

            if (!isRecording) {
                recordedChunks = [];
                mediaRecorder = new MediaRecorder(stream, { mimeType: 'video/webm;codecs=vp9' });
                mediaRecorder.ondataavailable = (e) => {
                    if (e.data.size > 0) recordedChunks.push(e.data);
                };
                mediaRecorder.onstop = () => {
                    const blob = new Blob(recordedChunks, { type: 'video/webm' });
                    const now = new Date();
                    const file = new File([blob], `ewitness_recording_${now.getTime()}.webm`, { type: 'video/webm' });
                    
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    handleFileSelected(fileInput);
                    indicator.style.display = 'none';
                };
                mediaRecorder.start(1000); // Chunk every second
                isRecording = true;
                btn.style.background = '#f87171';
                btn.style.color = '#fff';
                btn.style.borderColor = '#f87171';
                icon.className = 'ti ti-player-stop-filled';
                text.textContent = 'Stop';
                indicator.style.display = 'flex';
            } else {
                mediaRecorder.stop();
                isRecording = false;
                btn.style.background = 'rgba(239, 68, 68, 0.1)';
                btn.style.color = '#f87171';
                btn.style.borderColor = 'rgba(239, 68, 68, 0.3)';
                icon.className = 'ti ti-video';
                text.textContent = 'Record';
            }
        }

        // ═══════════════════════════════════════════════════════════
        // DRAG & DROP
        // ═══════════════════════════════════════════════════════════
        function handleDrop(event) {
            event.preventDefault();
            const fileInput = document.getElementById('file');
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileSelected(fileInput);
            }
            event.currentTarget.style.borderColor = 'rgba(71,85,105,0.5)';
            event.currentTarget.style.background = 'rgba(30,41,59,0.3)';
        }

        // CSS spin animation
        const style = document.createElement('style');
        style.textContent = '@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
        document.head.appendChild(style);
    </script>
</x-app-layout>
