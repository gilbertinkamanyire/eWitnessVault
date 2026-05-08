<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ti ti-files" style="font-size: 1.5rem; background: linear-gradient(135deg, #06b6d4, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #e2e8f0; font-family: 'Outfit', sans-serif;">Evidence List</h2>
            </div>
            <a href="{{ route('dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.875rem; color: #64748b; text-decoration: none; transition: color 0.2s; font-family: 'Outfit', sans-serif;"
               onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#64748b'">
                <i class="ti ti-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div style="padding: 2rem 1rem; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 1200px; margin: 0 auto;">

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

            @if($evidenceList->count() > 0)
            <!-- Evidence Table Card -->
            <div style="background: rgba(15,23,42,0.7); backdrop-filter: blur(20px); border: 1px solid rgba(34,211,238,0.15); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">

                <!-- Table Header -->
                <div style="padding: 1.25rem 1.75rem; border-bottom: 1px solid rgba(71,85,105,0.3); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(6,182,212,0.12); border: 1px solid rgba(6,182,212,0.25); display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-database" style="font-size: 1.1rem; color: #22d3ee;"></i>
                        </div>
                        <div>
                            <div style="font-size: 1rem; font-weight: 700; color: #e2e8f0;">
                                @if(Auth::user()->hasAnyRole(['Admin', 'Judge', 'Lawyer']))
                                    All Evidence Files
                                @else
                                    My Evidence Files
                                @endif
                            </div>
                            <div style="font-size: 0.8125rem; color: #475569;">{{ $evidenceList->count() }} record{{ $evidenceList->count() !== 1 ? 's' : '' }} found</div>
                        </div>
                    </div>
                    <a href="{{ route('upload') }}"
                       style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.5rem; background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; font-size: 0.875rem; font-weight: 700; border-radius: 10px; text-decoration: none; transition: all 0.25s; box-shadow: 0 4px 15px rgba(6,182,212,0.3); font-family: 'Outfit', sans-serif;"
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(6,182,212,0.5)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(6,182,212,0.3)';">
                        <i class="ti ti-cloud-upload"></i>
                        Upload New Evidence
                    </a>
                </div>

                <!-- Table / Card Grid -->
                <div>
                    <!-- Desktop Table -->
                    <div style="overflow-x: auto; display: none;" class="desktop-only">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: rgba(30,41,59,0.5);">
                                    <th style="padding: 0.875rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; white-space: nowrap;">
                                        <i class="ti ti-file-certificate" style="margin-right: 0.35rem; color: #22d3ee;"></i>Title
                                    </th>
                                    <th style="padding: 0.875rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px;">
                                        <i class="ti ti-align-left" style="margin-right: 0.35rem; color: #22d3ee;"></i>Description
                                    </th>
                                    @if(Auth::user()->hasAnyRole(['Admin', 'Judge', 'Lawyer']))
                                    <th style="padding: 0.875rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; white-space: nowrap;">
                                        <i class="ti ti-user" style="margin-right: 0.35rem; color: #22d3ee;"></i>Uploaded By
                                    </th>
                                    @endif
                                    <th style="padding: 0.875rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; white-space: nowrap;">
                                        <i class="ti ti-calendar" style="margin-right: 0.35rem; color: #22d3ee;"></i>Date
                                    </th>
                                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($evidenceList as $evidence)
                                <tr style="border-top: 1px solid rgba(71,85,105,0.15); transition: background 0.2s;"
                                    onmouseover="this.style.background='rgba(6,182,212,0.04)'"
                                    onmouseout="this.style.background='transparent'">
                                    <td style="padding: 1.25rem;">
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(6,182,212,0.1); border: 1px solid rgba(6,182,212,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="ti ti-file-certificate" style="font-size: 1rem; color: #22d3ee;"></i>
                                            </div>
                                            <div>
                                                <div style="font-size: 0.875rem; font-weight: 700; color: #e2e8f0;">{{ $evidence->title }}</div>
                                                <div style="font-size: 0.7rem; color: #334155; font-family: monospace;">{{ Str::limit($evidence->file_hash, 12) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 1.25rem; font-size: 0.875rem; color: #94a3b8; max-width: 250px;">
                                        {{ Str::limit($evidence->description ?? 'No description', 60) }}
                                    </td>
                                    @if(Auth::user()->hasAnyRole(['Admin', 'Judge', 'Lawyer']))
                                    <td style="padding: 1.25rem;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #06b6d4, #0891b2); display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 800; color: white;">
                                                {{ strtoupper(substr($evidence->user->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <span style="font-size: 0.875rem; color: #64748b;">{{ $evidence->user->name ?? 'Unknown' }}</span>
                                        </div>
                                    </td>
                                    @endif
                                    <td style="padding: 1.25rem; font-size: 0.875rem; color: #64748b;">
                                        {{ $evidence->created_at->format('M d, Y') }}
                                        <div style="font-size: 0.75rem; opacity: 0.6;">{{ $evidence->created_at->format('H:i') }}</div>
                                    </td>
                                    <td style="padding: 1.25rem;">
                                        <a href="{{ route('evidence.show', $evidence->id) }}"
                                           style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.45rem 1rem; background: rgba(34, 211, 238, 0.1); border: 1px solid rgba(34, 211, 238, 0.2); color: #22d3ee; font-size: 0.8125rem; font-weight: 700; border-radius: 8px; text-decoration: none; transition: all 0.2s;"
                                           onmouseover="this.style.background='rgba(34, 211, 238, 0.2)';"
                                           onmouseout="this.style.background='rgba(34, 211, 238, 0.1)';" class="hover-glow">
                                            <i class="ti ti-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="mobile-only" style="display: flex; flex-direction: column; gap: 1px; background: rgba(71,85,105,0.1);">
                        @foreach($evidenceList as $evidence)
                        <a href="{{ route('evidence.show', $evidence->id) }}" style="text-decoration: none; display: block; padding: 1.25rem; background: rgba(15, 23, 42, 0.4); transition: background 0.2s;"
                           onmouseover="this.style.background='rgba(30, 41, 59, 0.6)';"
                           onmouseout="this.style.background='rgba(15, 23, 42, 0.4)';" class="active-lift">
                            <div style="display: flex; gap: 1rem; align-items: flex-start;">
                                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(34, 211, 238, 0.1); border: 1px solid rgba(34, 211, 238, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="ti ti-file-certificate" style="font-size: 1.25rem; color: #22d3ee;"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                                        <h3 style="font-size: 0.9375rem; font-weight: 700; color: #f1f5f9; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0;">{{ $evidence->title }}</h3>
                                        <span style="font-size: 0.7rem; color: #475569;">{{ $evidence->created_at->format('M d') }}</span>
                                    </div>
                                    <p style="font-size: 0.8125rem; color: #64748b; margin: 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $evidence->description ?? 'No description provided.' }}
                                    </p>
                                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-top: 0.75rem;">
                                        <div style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; color: #334155;">
                                            <i class="ti ti-hash"></i>
                                            <span style="font-family: monospace;">{{ substr($evidence->file_hash, 0, 8) }}</span>
                                        </div>
                                        @if(Auth::user()->hasAnyRole(['Admin', 'Judge', 'Lawyer']))
                                        <div style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; color: #334155;">
                                            <i class="ti ti-user"></i>
                                            <span>{{ explode(' ', $evidence->user->name ?? 'User')[0] }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <i class="ti ti-chevron-right" style="color: #334155; margin-top: 0.5rem;"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <style>
                    @media (min-width: 769px) {
                        .desktop-only { display: block !important; }
                        .mobile-only { display: none !important; }
                    }
                    @media (max-width: 768px) {
                        .desktop-only { display: none !important; }
                        .mobile-only { display: flex !important; }
                    }
                    .active-lift:active {
                        background: rgba(30, 41, 59, 0.9) !important;
                        transform: scale(0.98);
                    }
                </style>

                <!-- Pagination -->
                @if($evidenceList->hasPages())
                <div style="padding: 1.5rem; border-top: 1px solid rgba(71,85,105,0.2); background: rgba(15,23,42,0.3);">
                    {{ $evidenceList->links() }}
                </div>
                @endif
            </div>
            </div>

            @else
            <!-- Empty State -->
            <div style="background: rgba(15,23,42,0.7); backdrop-filter: blur(20px); border: 1px solid rgba(34,211,238,0.1); border-radius: 20px; padding: 5rem 2rem; text-align: center; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
                <div style="width: 80px; height: 80px; border-radius: 20px; background: rgba(71,85,105,0.2); border: 1px solid rgba(71,85,105,0.3); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="ti ti-folder-x" style="font-size: 2.5rem; color: #334155;"></i>
                </div>
                <h3 style="font-size: 1.375rem; font-weight: 700; color: #e2e8f0; margin-bottom: 0.75rem;">No Evidence Found</h3>
                <p style="font-size: 0.9375rem; color: #475569; max-width: 400px; margin: 0 auto 2rem; line-height: 1.6;">
                    Your vault is empty. Start by uploading your first evidence file to secure it.
                </p>
                <a href="{{ route('upload') }}"
                   style="display: inline-flex; align-items: center; gap: 0.6rem; padding: 0.85rem 2rem; background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; font-size: 1rem; font-weight: 700; border-radius: 50px; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 20px rgba(6,182,212,0.3); font-family: 'Outfit', sans-serif;"
                   onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 30px rgba(6,182,212,0.5)';"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(6,182,212,0.3)';">
                    <i class="ti ti-cloud-upload"></i>
                    Upload Your First Evidence
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
