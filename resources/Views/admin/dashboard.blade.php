<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | eWitnessVault</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tabler Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/css/dashboard-new.css'])
</head>
<body class="dashboard-body admin-dashboard" style="font-family: 'Outfit', sans-serif; background: #080a19;">
    <!-- Background with overlay -->
    <div class="dashboard-background" style="position: fixed; inset: 0; background-image: url('{{ asset('images/home-bg.png') }}'); background-size: cover; background-position: center; z-index: -1;"></div>
    <div style="position: fixed; inset: 0; background: linear-gradient(135deg, rgba(8, 10, 25, 0.95) 0%, rgba(5, 30, 50, 0.98) 100%); z-index: -1;"></div>
    
    <!-- Navigation -->
    @include('layouts.dashboard-nav')
    
    <div class="dashboard-container" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
        <!-- Admin Hero Header -->
        <header class="dashboard-hero admin-hero" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 20px; padding: 2.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; display: flex; justify-content: space-between; align-items: center;">
            <!-- Background glow -->
            <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(168, 85, 247, 0.15); filter: blur(40px); border-radius: 50%;"></div>
            
            <div class="hero-content">
                <i class="ti ti-shield-cog" style="font-size: 3rem; background: linear-gradient(135deg, #a855f7, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1rem; display: block; filter: drop-shadow(0 0 10px rgba(168, 85, 247, 0.5));"></i>
                <h1 class="hero-title" style="font-size: 2.25rem; font-weight: 800; color: #f1f5f9; margin-bottom: 0.5rem; letter-spacing: -0.5px;">Admin Control Center</h1>
                <p class="hero-subtitle" style="font-size: 1rem; color: #94a3b8; font-weight: 300;">Complete system oversight and management</p>
            </div>
            
            <div class="system-badge" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); padding: 0.5rem 1rem; border-radius: 50px; display: flex; align-items: center; gap: 0.5rem; color: #4ade80; font-size: 0.8125rem; font-weight: 600;">
                <span class="badge-dot" style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block; animation: pulse 2s infinite;"></span>
                <span>System Active</span>
            </div>
        </header>

        <!-- Admin Stats Grid -->
        <section class="stats-section" style="margin-bottom: 3rem;">
            <div class="stats-grid admin-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
                <!-- Total Users -->
                <div class="stat-card" style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.2); border-radius: 16px; padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem; transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #60a5fa;">
                        <i class="ti ti-users"></i>
                    </div>
                    <div>
                        <div style="font-size: 1.75rem; font-weight: 800; color: #f1f5f9; line-height: 1;">{{ $totalUsers }}</div>
                        <div style="font-size: 0.8125rem; font-weight: 600; color: #64748b; margin-top: 0.25rem;">Total Users</div>
                        <div style="font-size: 0.75rem; color: #4ade80; margin-top: 0.4rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="ti ti-activity" style="font-size: 0.8rem;"></i>
                            Platform Activity
                        </div>
                    </div>
                </div>

                <!-- Verified Users -->
                <div class="stat-card" style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.2); border-radius: 16px; padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem; transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #4ade80;">
                        <i class="ti ti-shield-check"></i>
                    </div>
                    <div>
                        <div style="font-size: 1.75rem; font-weight: 800; color: #f1f5f9; line-height: 1;">{{ $verifiedUsers }}</div>
                        <div style="font-size: 0.8125rem; font-weight: 600; color: #64748b; margin-top: 0.25rem;">Verified Accounts</div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.4rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="ti ti-check" style="font-size: 0.8rem;"></i>
                            Trusted Users
                        </div>
                    </div>
                </div>

                <!-- Pending Review -->
                <div class="stat-card" style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.2); border-radius: 16px; padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem; transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fbbf24;">
                        <i class="ti ti-clock-pause"></i>
                    </div>
                    <div>
                        <div style="font-size: 1.75rem; font-weight: 800; color: #f1f5f9; line-height: 1;">{{ $pendingVerification }}</div>
                        <div style="font-size: 0.8125rem; font-weight: 600; color: #64748b; margin-top: 0.25rem;">Pending Review</div>
                        <div style="font-size: 0.75rem; color: {{ $pendingVerification > 0 ? '#f87171' : '#94a3b8' }}; margin-top: 0.4rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="ti ti-alert-circle" style="font-size: 0.8rem;"></i>
                            Awaiting Action
                        </div>
                    </div>
                </div>

                <!-- Total Evidence -->
                <div class="stat-card" style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.2); border-radius: 16px; padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem; transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(6, 182, 212, 0.1); border: 1px solid rgba(6, 182, 212, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #22d3ee;">
                        <i class="ti ti-files"></i>
                    </div>
                    <div>
                        <div style="font-size: 1.75rem; font-weight: 800; color: #f1f5f9; line-height: 1;">{{ $totalEvidence }}</div>
                        <div style="font-size: 0.8125rem; font-weight: 600; color: #64748b; margin-top: 0.25rem;">Total Evidence</div>
                        <div style="font-size: 0.75rem; color: #22d3ee; margin-top: 0.4rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="ti ti-database" style="font-size: 0.8rem;"></i>
                            Secured Vaults
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Admin Actions & Metrics -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 3rem;">
            <!-- Actions Section -->
            <section>
                <div style="margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.25rem;">Administration Tools</h2>
                    <p style="font-size: 0.875rem; color: #64748b;">Efficiently manage platform resources</p>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <a href="{{ route('admin.users') }}" style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(168, 85, 247, 0.15); border-radius: 16px; padding: 1.25rem; text-decoration: none; transition: all 0.3s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.background='rgba(168, 85, 247, 0.05)'; this.style.borderColor='rgba(168, 85, 247, 0.4)'" onmouseout="this.style.background='rgba(15, 23, 42, 0.7)'; this.style.borderColor='rgba(168, 85, 247, 0.15)'">
                        <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: #c084fc;">
                            <i class="ti ti-users-group"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.9375rem; font-weight: 700; color: #f1f5f9;">User Directory</div>
                            <div style="font-size: 0.75rem; color: #64748b;">Manage all users</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.users.create') }}" style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(34, 197, 94, 0.15); border-radius: 16px; padding: 1.25rem; text-decoration: none; transition: all 0.3s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.background='rgba(34, 197, 94, 0.05)'; this.style.borderColor='rgba(34, 197, 94, 0.4)'" onmouseout="this.style.background='rgba(15, 23, 42, 0.7)'; this.style.borderColor='rgba(34, 197, 94, 0.15)'">
                        <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: #4ade80;">
                            <i class="ti ti-user-plus"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.9375rem; font-weight: 700; color: #f1f5f9;">Create User</div>
                            <div style="font-size: 0.75rem; color: #64748b;">Add new account</div>
                        </div>
                    </a>

                    <a href="{{ route('evidence.index') }}" style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(6, 182, 212, 0.15); border-radius: 16px; padding: 1.25rem; text-decoration: none; transition: all 0.3s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.background='rgba(6, 182, 212, 0.05)'; this.style.borderColor='rgba(6, 182, 212, 0.4)'" onmouseout="this.style.background='rgba(15, 23, 42, 0.7)'; this.style.borderColor='rgba(6, 182, 212, 0.15)'">
                        <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(6, 182, 212, 0.1); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: #22d3ee;">
                            <i class="ti ti-file-analytics"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.9375rem; font-weight: 700; color: #f1f5f9;">Global Vault</div>
                            <div style="font-size: 0.75rem; color: #64748b;">System evidence</div>
                        </div>
                    </a>
                </div>

                <!-- Verification Queue -->
                @if($pendingUsers->count() > 0)
                <div style="margin-top: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h3 style="font-size: 1rem; font-weight: 700; color: #f1f5f9;">Verification Queue</h3>
                        <span style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; padding: 0.2rem 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; border: 1px solid rgba(245, 158, 11, 0.3);">{{ $pendingUsers->count() }} Pending</span>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @foreach($pendingUsers as $user)
                        <div style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(71, 85, 105, 0.2); border-radius: 16px; padding: 1rem 1.25rem; display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #a855f7, #6366f1); display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 700; color: white;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-size: 0.9375rem; font-weight: 600; color: #f1f5f9;">{{ $user->name }}</div>
                                    <div style="font-size: 0.75rem; color: #64748b; font-family: monospace;">{{ $user->email }}</div>
                                </div>
                                <div style="display: flex; gap: 0.25rem; margin-left: 0.5rem;">
                                    @foreach($user->roles as $role)
                                        <span style="background: rgba(99, 102, 241, 0.1); color: #818cf8; padding: 0.1rem 0.5rem; border-radius: 4px; font-size: 0.65rem; font-weight: 700; border: 1px solid rgba(99, 102, 241, 0.2);">{{ $role->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.5rem;">
                                <form action="{{ route('admin.users.verify', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: rgba(34, 197, 94, 0.1); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); padding: 0.4rem 0.75rem; border-radius: 8px; font-size: 0.8125rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(34, 197, 94, 0.2)'" onmouseout="this.style.background='rgba(34, 197, 94, 0.1)'">
                                        <i class="ti ti-check" style="margin-right: 0.25rem;"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: rgba(239, 68, 68, 0.05); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); padding: 0.4rem 0.75rem; border-radius: 8px; font-size: 0.8125rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.15)'" onmouseout="this.style.background='rgba(239, 68, 68, 0.05)'" onclick="return confirm('Reject this user?')">
                                        <i class="ti ti-x" style="margin-right: 0.25rem;"></i> Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </section>

            <!-- Sidebar / Health Status -->
            <aside>
                <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.2); border-radius: 20px; padding: 1.5rem;">
                    <h3 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 1.25rem;">System Health</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center; color: #4ade80;">
                                <i class="ti ti-server-2"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                                    <span style="font-size: 0.8125rem; font-weight: 600; color: #f1f5f9;">Server Status</span>
                                    <span style="font-size: 0.65rem; color: #4ade80; font-weight: 800;">OK</span>
                                </div>
                                <div style="height: 4px; background: rgba(71, 85, 105, 0.2); border-radius: 2px;">
                                    <div style="width: 100%; height: 100%; background: #4ade80; border-radius: 2px;"></div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center; color: #60a5fa;">
                                <i class="ti ti-database"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                                    <span style="font-size: 0.8125rem; font-weight: 600; color: #f1f5f9;">Database</span>
                                    <span style="font-size: 0.65rem; color: #60a5fa; font-weight: 800;">82% Load</span>
                                </div>
                                <div style="height: 4px; background: rgba(71, 85, 105, 0.2); border-radius: 2px;">
                                    <div style="width: 82%; height: 100%; background: #60a5fa; border-radius: 2px;"></div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(244, 63, 94, 0.1); display: flex; align-items: center; justify-content: center; color: #fb7185;">
                                <i class="ti ti-shield-lock"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                                    <span style="font-size: 0.8125rem; font-weight: 600; color: #f1f5f9;">Security Scope</span>
                                    <span style="font-size: 0.65rem; color: #fb7185; font-weight: 800;">ULTRA</span>
                                </div>
                                <div style="height: 4px; background: rgba(71, 85, 105, 0.2); border-radius: 2px;">
                                    <div style="width: 95%; height: 100%; background: #fb7185; border-radius: 2px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(71, 85, 105, 0.2);">
                        <div style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 1rem;">Recent Sign-ups</div>
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($recentUsers as $user)
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(51, 65, 85, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700; color: #e2e8f0;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-size: 0.8125rem; font-weight: 600; color: #f1f5f9; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $user->name }}</div>
                                    <div style="font-size: 0.65rem; color: #64748b;">{{ $user->created_at->diffForHumans() }}</div>
                                </div>
                                @if($user->roles->isNotEmpty())
                                    <span style="font-size: 0.6rem; font-weight: 700; color: #22d3ee; background: rgba(6, 182, 212, 0.1); padding: 0.1rem 0.4rem; border-radius: 40px; border: 1px solid rgba(6, 182, 212, 0.2);">{{ $user->roles->first()->name }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <footer class="dashboard-footer" style="padding: 2rem 0; text-align: center; border-top: 1px solid rgba(71, 85, 105, 0.15); margin-top: 4rem;">
        <div class="footer-content">
            <div class="footer-text" style="font-size: 0.875rem; color: #475569;">
                &copy; {{ date('Y') }} eWitnessVault &mdash; Unified System Administration
            </div>
            <div class="footer-brand" style="font-size: 0.8125rem; color: #64748b; margin-top: 0.5rem;">
                Powered by <span style="font-weight: 700; color: #22d3ee;">Tinka Platform</span>
            </div>
        </div>
    </footer>

    <style>
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</body>
</html>