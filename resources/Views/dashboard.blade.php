<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PWA / Mobile Theme -->
    <meta name="theme-color" content="#0f172a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="eWitnessVault">
    
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/images/logo-192.png">

    <title>Dashboard | eWitnessVault</title>

    <script>
        window.isNative = false;
        if (window.Capacitor && window.Capacitor.isNative) {
            window.isNative = true;
            document.documentElement.classList.add('native-app');
        }

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then(reg => {
                    console.log('SW (Dashboard) registered:', reg);
                });
            });
        }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Tabler Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/css/dashboard-new.css'])
</head>
<body class="dashboard-body">
    <!-- Background with overlay -->
    <div class="dashboard-background"></div>
    
    <!-- Navigation -->
    @include('layouts.dashboard-nav')
    
    <!-- Main Dashboard Content -->
    <div class="dashboard-container">
        <!-- Header Section -->
        <header class="dashboard-hero {{ $features['role_name'] === 'Judge' ? 'judge-hero' : ($features['role_name'] === 'Lawyer' ? 'lawyer-hero' : ($features['role_name'] === 'Investigator' ? 'investigator-hero' : '')) }}">
            <div class="hero-content">
                <i class="ti {{ $features['role_icon'] }} hero-icon"></i>
                <h1 class="hero-title">Welcome, {{ Auth::user()->name }}</h1>
                <p class="hero-subtitle">
                    @if($features['role_name'] === 'Judge')
                        Judicial Dashboard - Review and manage evidence cases
                    @elseif($features['role_name'] === 'Lawyer')
                        Legal Dashboard - Upload and manage case evidence
                    @elseif($features['role_name'] === 'Investigator')
                        Investigator Dashboard - Analyze and track evidence
                    @elseif($features['role_name'] === 'Administrator')
                        Administrator Dashboard - Full system access
                    @else
                        Personal Evidence Vault - Secure storage and management
                    @endif
                </p>
            </div>
            <div class="role-badge">
                <i class="ti {{ $features['role_icon'] }}"></i>
                <span>{{ $features['role_name'] }}</span>
            </div>
        </header>

        <!-- Stats Grid -->
        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-card stat-primary">
                    <div class="stat-icon">
                        <i class="ti ti-file-certificate"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['user_evidence'] ?? 0 }}</div>
                        <div class="stat-label">My Evidence</div>
                        <div class="stat-trend">
                            <i class="ti ti-shield-check"></i>
                            <span>Secured Files</span>
                        </div>
                    </div>
                </div>

                @if($features['can_view_all'])
                <div class="stat-card stat-secondary">
                    <div class="stat-icon">
                        <i class="ti ti-database"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['total_evidence'] ?? 0 }}</div>
                        <div class="stat-label">
                            @if($features['role_name'] === 'Judge')
                                All Cases
                            @elseif($features['role_name'] === 'Investigator')
                                System Evidence
                            @else
                                Total Evidence
                            @endif
                        </div>
                        <div class="stat-trend">
                            <i class="ti ti-folder"></i>
                            <span>{{ $features['role_name'] === 'Judge' ? 'Under Review' : 'System Wide' }}</span>
                        </div>
                    </div>
                </div>
                @endif

                @if($features['role_name'] === 'Judge' && isset($stats['pending_review']))
                <div class="stat-card stat-warning">
                    <div class="stat-icon">
                        <i class="ti ti-clock-pause"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['pending_review'] }}</div>
                        <div class="stat-label">Pending Review</div>
                        <div class="stat-trend">
                            <i class="ti ti-alert-circle"></i>
                            <span>Awaiting Decision</span>
                        </div>
                    </div>
                </div>
                @endif

                @if($features['role_name'] === 'Lawyer' && isset($stats['active_cases']))
                <div class="stat-card stat-info">
                    <div class="stat-icon">
                        <i class="ti ti-briefcase"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['active_cases'] }}</div>
                        <div class="stat-label">Active Cases</div>
                        <div class="stat-trend">
                            <i class="ti ti-folder-open"></i>
                            <span>In Progress</span>
                        </div>
                    </div>
                </div>
                @endif

                @if($features['role_name'] === 'Investigator' && isset($stats['assigned_cases']))
                <div class="stat-card stat-info">
                    <div class="stat-icon">
                        <i class="ti ti-search"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['assigned_cases'] }}</div>
                        <div class="stat-label">Assigned Cases</div>
                        <div class="stat-trend">
                            <i class="ti ti-user-check"></i>
                            <span>Under Investigation</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="stat-card stat-success">
                    <div class="stat-icon">
                        <i class="ti ti-shield-lock"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">AES-256</div>
                        <div class="stat-label">Encryption</div>
                        <div class="stat-trend">
                            <i class="ti ti-lock"></i>
                            <span>Military Grade</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="actions-section">
            <div class="section-header">
                <h2 class="section-title">Quick Actions</h2>
                <p class="section-subtitle">Streamline your workflow</p>
            </div>
            <div class="actions-grid">
                <a href="{{ route('upload') }}" class="action-card action-primary">
                    <div class="action-icon">
                        <i class="ti ti-cloud-upload"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Upload Evidence</h3>
                        <p class="action-description">Add new files to your vault</p>
                    </div>
                    <div class="action-arrow">
                        <i class="ti ti-arrow-right"></i>
                    </div>
                </a>

                <a href="{{ route('evidence.index') }}" class="action-card action-secondary">
                    <div class="action-icon">
                        <i class="ti ti-files"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Browse Evidence</h3>
                        <p class="action-description">View all your files</p>
                    </div>
                    <div class="action-arrow">
                        <i class="ti ti-arrow-right"></i>
                    </div>
                </a>

                @if($features['role_name'] === 'Judge')
                <a href="{{ route('evidence.index') }}" class="action-card action-warning">
                    <div class="action-icon">
                        <i class="ti ti-gavel"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Review Cases</h3>
                        <p class="action-description">Judicial oversight</p>
                    </div>
                    <div class="action-arrow">
                        <i class="ti ti-arrow-right"></i>
                    </div>
                </a>
                @endif

                @if($features['role_name'] === 'Investigator')
                <a href="{{ route('evidence.index') }}" class="action-card action-info">
                    <div class="action-icon">
                        <i class="ti ti-search"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Analyze Evidence</h3>
                        <p class="action-description">Investigation tools</p>
                    </div>
                    <div class="action-arrow">
                        <i class="ti ti-arrow-right"></i>
                    </div>
                </a>
                @endif
                <a href="{{ route('upload') }}" class="action-card action-success">
                    <div class="action-icon">
                        <i class="ti ti-camera-selfie"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Digital Capture</h3>
                        <p class="action-description">Capture with GPS & Time</p>
                    </div>
                    <div class="action-badge">Verified</div>
                    <div class="action-arrow">
                        <i class="ti ti-arrow-right"></i>
                    </div>
                </a>
            </div>

        </section>

        <!-- Recent Evidence -->
        @if(isset($evidenceList) && $evidenceList->count() > 0)
        <section class="evidence-section">
            <div class="section-header">
                <h2 class="section-title">Recent Evidence</h2>
                <a href="{{ route('evidence.index') }}" class="section-link">
                    View All <i class="ti ti-arrow-right"></i>
                </a>
            </div>
            <div class="evidence-table-container">
                <table class="evidence-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Upload Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evidenceList->take(5) as $evidence)
                        <tr class="evidence-row">
                            <td>
                                <div class="evidence-title">
                                    <i class="ti ti-file-certificate"></i>
                                    <span>{{ $evidence->title ?? 'Untitled' }}</span>
                                </div>
                            </td>
                            <td class="evidence-description">{{ Str::limit($evidence->description ?? 'No description', 50) }}</td>
                            <td class="evidence-date">{{ $evidence->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="status-badge status-verified">
                                    <i class="ti ti-shield-check"></i>
                                    Verified
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('evidence.show', $evidence->id) }}" class="btn-action">
                                    <i class="ti ti-eye"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @else
        <!-- Empty State -->
        <section class="empty-state">
            <div class="empty-content">
                <i class="ti ti-folder-x empty-icon"></i>
                <h3 class="empty-title">No Evidence Yet</h3>
                <p class="empty-description">Start by uploading your first evidence file to the secure vault</p>
                <a href="{{ route('upload') }}" class="btn-primary-glow">
                    <i class="ti ti-cloud-upload"></i>
                    Upload Evidence
                </a>
            </div>
        </section>
        @endif

        <!-- System Status -->
        <section class="status-section">
            <div class="status-grid">
                <div class="status-card">
                    <i class="ti ti-server-2"></i>
                    <div>
                        <div class="status-label">System Status</div>
                        <div class="status-value status-active">Operational</div>
                    </div>
                </div>
                <div class="status-card">
                    <i class="ti ti-shield-check"></i>
                    <div>
                        <div class="status-label">Security</div>
                        <div class="status-value status-active">Protected</div>
                    </div>
                </div>
                <div class="status-card">
                    <i class="ti ti-device-mobile"></i>
                    <div>
                        <div class="status-label">Platform</div>
                        <div id="platform-status" class="status-value">Detecting...</div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const platformStatus = document.getElementById('platform-status');
                if (window.isNative) {
                    platformStatus.textContent = 'Native App';
                    platformStatus.className = 'status-value status-active';
                } else if (window.matchMedia('(display-mode: standalone)').matches) {
                    platformStatus.textContent = 'PWA Installed';
                    platformStatus.className = 'status-value status-active';
                } else {
                    platformStatus.textContent = 'Web Browser';
                    platformStatus.className = 'status-value status-active';
                }
            });
        </script>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="footer-content">
            <div class="footer-text">
                &copy; {{ date('Y') }} eWitnessVault &mdash; Your digital evidence, protected.
            </div>
            <div class="footer-brand">
                Designed by <span>Tinka</span>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    @auth
        @include('components.bottom-nav')
    @endauth

    @vite(['resources/js/app.js'])
</body>
</html>