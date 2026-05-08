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

        <title>{{ config('app.name', 'eWitnessVault') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

        <!-- Tabler Icons -->
        <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet">

        <!-- Capacitor Core JS (Safe detection) -->
        <script>
            window.isNative = false;
            // Native detection
            if (window.Capacitor && window.Capacitor.isNative) {
                window.isNative = true;
                document.documentElement.classList.add('native-app');
            }

            // Service Worker Registration
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js').then(reg => {
                        console.log('SW (Guest) registered:', reg);
                    }).catch(err => {
                        console.log('SW (Guest) registration failed:', err);
                    });
                });
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }

            html, body { height: 100%; font-family: 'Outfit', sans-serif; }

            .auth-body {
                min-height: 100vh;
                overflow-y: auto;
                background-image: url("{{ asset('images/home-bg.png') }}");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
            }

            .auth-body::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(8, 10, 25, 0.93) 0%, rgba(5, 30, 50, 0.97) 100%);
                z-index: 0;
            }

            /* Animated background orbs */
            .auth-orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.15;
                z-index: 0;
                animation: orbFloat 8s ease-in-out infinite;
            }
            .auth-orb-1 { width: 400px; height: 400px; background: #06b6d4; top: -100px; right: -100px; animation-delay: 0s; }
            .auth-orb-2 { width: 300px; height: 300px; background: #0891b2; bottom: -80px; left: -80px; animation-delay: 3s; }

            @keyframes orbFloat {
                0%, 100% { transform: translateY(0px) scale(1); }
                50% { transform: translateY(-30px) scale(1.05); }
            }

            .auth-container {
                position: relative;
                z-index: 10;
                width: 100%;
                max-width: 440px;
                margin: auto;
            }

            /* Brand header above card */
            .auth-brand {
                text-align: center;
                margin-bottom: 1.5rem;
            }
            .auth-brand-icon {
                font-size: 3rem;
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                display: block;
                margin-bottom: 0.5rem;
                filter: drop-shadow(0 0 20px rgba(6, 182, 212, 0.5));
            }
            .auth-brand-name {
                font-size: 1.5rem;
                font-weight: 800;
                background: linear-gradient(to right, #ffffff, #22d3ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                letter-spacing: 1px;
            }
            .auth-brand-tagline {
                font-size: 0.8rem;
                color: rgba(148, 163, 184, 0.8);
                margin-top: 0.25rem;
                letter-spacing: 0.5px;
            }

            /* Glassmorphism card */
            .auth-card {
                background: rgba(15, 23, 42, 0.7);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(34, 211, 238, 0.2);
                border-radius: 20px;
                padding: 2.25rem 2rem;
                box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(34, 211, 238, 0.05) inset;
                width: 100%;
            }

            .auth-card__header {
                text-align: center;
                margin-bottom: 1.75rem;
            }

            .auth-card__title {
                font-size: 1.75rem;
                font-weight: 700;
                color: #f1f5f9;
                margin-bottom: 0.35rem;
            }

            .auth-card__subtitle {
                font-size: 0.875rem;
                color: #64748b;
            }

            /* Form */
            .auth-form {
                display: flex;
                flex-direction: column;
                gap: 1.1rem;
            }

            .auth-form__field {
                display: flex;
                flex-direction: column;
                gap: 0.4rem;
            }

            .auth-label {
                font-size: 0.8125rem;
                font-weight: 600;
                color: #94a3b8;
                letter-spacing: 0.3px;
            }

            /* Input with icon */
            .input-icon-wrapper {
                position: relative;
                display: flex;
                align-items: center;
            }
            .input-icon {
                position: absolute;
                left: 0.875rem;
                color: #475569;
                font-size: 1rem;
                pointer-events: none;
                z-index: 1;
                transition: color 0.2s;
            }
            .auth-input {
                width: 100%;
                padding: 0.7rem 0.875rem 0.7rem 2.5rem;
                background: rgba(30, 41, 59, 0.6);
                border: 1.5px solid rgba(71, 85, 105, 0.5);
                border-radius: 10px;
                font-size: 0.875rem;
                font-family: 'Outfit', sans-serif;
                color: #e2e8f0;
                transition: all 0.25s;
            }
            .auth-input::placeholder { color: #475569; }
            .auth-input:focus {
                outline: none;
                border-color: #06b6d4;
                background: rgba(30, 41, 59, 0.9);
                box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.15);
            }
            .auth-input:focus + .input-icon,
            .input-icon-wrapper:focus-within .input-icon {
                color: #06b6d4;
            }

            /* Select */
            .auth-input option {
                background: #1e293b;
                color: #e2e8f0;
            }

            /* Password wrapper */
            .password-wrapper {
                position: relative;
                width: 100%;
            }
            .password-toggle {
                position: absolute;
                right: 0.75rem;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #475569;
                font-size: 1.1rem;
                cursor: pointer;
                padding: 0.25rem;
                transition: color 0.2s;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 2;
            }
            .password-toggle:hover { color: #06b6d4; }

            /* Button */
            .auth-button {
                width: 100%;
                padding: 0.8rem 1.25rem;
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
                color: white;
                font-weight: 700;
                font-size: 0.9375rem;
                font-family: 'Outfit', sans-serif;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                transition: all 0.25s;
                margin-top: 0.35rem;
                letter-spacing: 0.5px;
                box-shadow: 0 4px 20px rgba(6, 182, 212, 0.3);
                position: relative;
                overflow: hidden;
            }
            .auth-button::before {
                content: '';
                position: absolute;
                top: 0; left: -100%;
                width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
                transition: left 0.5s;
            }
            .auth-button:hover::before { left: 100%; }
            .auth-button:hover {
                background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
                transform: translateY(-2px);
                box-shadow: 0 8px 30px rgba(6, 182, 212, 0.5);
            }
            .auth-button:active { transform: translateY(0); }

            /* Meta row */
            .auth-meta {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 0.8125rem;
            }
            .auth-checkbox {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                color: #64748b;
                cursor: pointer;
            }
            .auth-checkbox input[type="checkbox"] {
                width: 15px; height: 15px;
                accent-color: #06b6d4;
                cursor: pointer;
            }

            /* Links */
            .auth-link {
                color: #22d3ee;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s;
            }
            .auth-link:hover { color: #06b6d4; text-decoration: underline; }

            /* Footer */
            .auth-footer {
                text-align: center;
                margin-top: 1.5rem;
                font-size: 0.875rem;
                color: #475569;
            }

            /* Alerts */
            .auth-alert {
                padding: 0.7rem 1rem;
                border-radius: 10px;
                font-size: 0.8125rem;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            .auth-alert--success {
                background: rgba(16, 185, 129, 0.1);
                color: #6ee7b7;
                border: 1px solid rgba(16, 185, 129, 0.3);
            }
            .auth-alert--error {
                background: rgba(239, 68, 68, 0.1);
                color: #fca5a5;
                border: 1px solid rgba(239, 68, 68, 0.3);
            }
            .auth-error {
                color: #f87171;
                font-size: 0.75rem;
                margin-top: 0.2rem;
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            /* Divider */
            .auth-divider {
                height: 1px;
                background: rgba(71, 85, 105, 0.3);
                margin: 0.5rem 0;
            }

            @media (max-width: 480px) {
                .auth-card { padding: 1.75rem 1.25rem; border-radius: 16px; }
                .auth-brand-icon { font-size: 2.5rem; }
                .auth-brand-name { font-size: 1.25rem; }
            }
        </style>
    </head>
    <body class="auth-body">
        <div class="auth-orb auth-orb-1"></div>
        <div class="auth-orb auth-orb-2"></div>

        <div class="auth-container">
            <!-- Brand Header -->
            <div class="auth-brand">
                <i class="ti ti-shield-check-filled auth-brand-icon"></i>
                <div class="auth-brand-name">eWitnessVault</div>
                <div class="auth-brand-tagline">Secure Digital Evidence Platform</div>
            </div>

            <!-- Auth Card -->
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
