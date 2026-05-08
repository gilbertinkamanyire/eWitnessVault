<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pending Verification | eWitnessVault</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tabler Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/css/dashboard-new.css'])
</head>
<body class="dashboard-body" style="font-family: 'Outfit', sans-serif; background: #080a19; min-height: 100vh; display: flex; flex-direction: column;">
    <!-- Background with overlay -->
    <div class="dashboard-background" style="position: fixed; inset: 0; background-image: url('{{ asset('images/home-bg.png') }}'); background-size: cover; background-position: center; z-index: -1;"></div>
    <div style="position: fixed; inset: 0; background: linear-gradient(135deg, rgba(8, 10, 25, 0.9) 0%, rgba(5, 30, 50, 0.95) 100%); z-index: -1;"></div>
    
    <!-- Navigation (Simple) -->
    <nav style="padding: 1.5rem; display: flex; justify-content: center; position: relative; z-index: 10;">
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <i class="ti ti-shield-check-filled" style="font-size: 1.8rem; background: linear-gradient(135deg, #06b6d4, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
            <span style="font-size: 1.5rem; font-weight: 800; color: white; letter-spacing: -0.5px;">eWitnessVault</span>
        </div>
    </nav>
    
    <div style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem 1rem; position: relative; z-index: 10;">
        <div style="max-width: 550px; width: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 30px; padding: 3rem 2rem; text-align: center; box-shadow: 0 40px 100px -20px rgba(0,0,0,0.6);">
            
            <div style="width: 80px; height: 80px; border-radius: 24px; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; animation: float 3s ease-in-out infinite;">
                <i class="ti ti-clock-pause" style="font-size: 2.5rem; color: #fbbf24;"></i>
            </div>

            <h1 style="font-size: 1.75rem; font-weight: 800; color: #f1f5f9; margin-bottom: 1rem; letter-spacing: -0.5px;">Account Under Review</h1>
            
            <p style="font-size: 1rem; color: #94a3b8; line-height: 1.6; margin-bottom: 2rem;">
                Thank you for registering as a 
                <span style="color: #22d3ee; font-weight: 700;">
                    @if(Auth::user()->hasRole('Judge'))
                        Judge
                    @elseif(Auth::user()->hasRole('Lawyer'))
                        Lawyer
                    @else
                        Specialized Operator
                    @endif
                </span>.
                Your credentials are currently being validated by our system administrators.
            </p>
            
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem; background: rgba(30, 41, 59, 0.4); padding: 0.75rem 1.25rem; border-radius: 12px; border: 1px solid rgba(71, 85, 105, 0.2);">
                    <i class="ti ti-shield-check" style="color: #4ade80;"></i>
                    <span style="font-size: 0.875rem; color: #cbd5e1; font-weight: 600;">Security Clearance Pending</span>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem; background: rgba(30, 41, 59, 0.4); padding: 0.75rem 1.25rem; border-radius: 12px; border: 1px solid rgba(71, 85, 105, 0.2);">
                    <i class="ti ti-mail" style="color: #60a5fa;"></i>
                    <span style="font-size: 0.875rem; color: #cbd5e1; font-weight: 600;">Status Alert Dispatch Enabled</span>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem; background: rgba(30, 41, 59, 0.4); padding: 0.75rem 1.25rem; border-radius: 12px; border: 1px solid rgba(71, 85, 105, 0.2);">
                    <i class="ti ti-lock-access" style="color: #22d3ee;"></i>
                    <span style="font-size: 0.875rem; color: #cbd5e1; font-weight: 600;">Full Vault Access Upon Approval</span>
                </div>
            </div>

            <div style="padding-top: 1.5rem; border-top: 1px solid rgba(71, 85, 105, 0.2); display: flex; flex-direction: column; gap: 1.5rem;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 0.85rem; background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 12px; color: #f87171; font-weight: 700; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.15)'" onmouseout="this.style.background='rgba(239, 68, 68, 0.05)'">
                        <i class="ti ti-logout" style="margin-right: 0.5rem;"></i>
                        Secure Logout
                    </button>
                </form>
                
                <p style="font-size: 0.75rem; color: #475569;">
                    Emergency assistance: <a href="mailto:support@ewitnessvault.com" style="color: #64748b; text-decoration: underline;">support@ewitnessvault.com</a>
                </p>
            </div>
        </div>
    </div>

    <footer style="padding: 2rem; text-align: center; color: #475569; font-size: 0.8125rem;">
        &copy; {{ date('Y') }} eWitnessVault Security Infrastructure
    </footer>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</body>
</html>