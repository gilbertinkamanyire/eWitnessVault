<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>eWitnessVault | Secure Digital Evidence</title>
        <meta name="description" content="The definitive platform for secure, tamper-proof digital evidence. Preserving truth with immutable technology.">

        <!-- PWA Support -->
        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#0f172a">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="apple-touch-icon" href="/images/logo-192.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap" rel="stylesheet">

        <!-- Tabler Icons -->
        <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet">

        <style>
            *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

            body {
                min-height: 100vh;
                font-family: 'Outfit', sans-serif;
                color: white;
                background-image: url("{{ asset('images/home-bg.png') }}");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                display: flex;
                flex-direction: column;
                position: relative;
                overflow-x: hidden;
            }

            body::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(8, 10, 25, 0.88) 0%, rgba(5, 30, 55, 0.85) 100%);
                z-index: 0;
            }

            /* Floating particles */
            .particles {
                position: absolute;
                inset: 0;
                z-index: 1;
                overflow: hidden;
                pointer-events: none;
            }
            .particle {
                position: absolute;
                width: 3px;
                height: 3px;
                background: rgba(34, 211, 238, 0.6);
                border-radius: 50%;
                animation: particleFloat linear infinite;
            }
            @keyframes particleFloat {
                0% { transform: translateY(100vh) translateX(0); opacity: 0; }
                10% { opacity: 1; }
                90% { opacity: 1; }
                100% { transform: translateY(-100px) translateX(var(--drift)); opacity: 0; }
            }

            /* Top Nav Bar */
            .top-nav {
                position: relative;
                z-index: 50;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.25rem 2rem;
                background: rgba(8, 10, 25, 0.5);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(34, 211, 238, 0.1);
            }
            .top-nav-brand {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                text-decoration: none;
            }
            .top-nav-brand i {
                font-size: 1.5rem;
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .top-nav-brand span {
                font-size: 1.1rem;
                font-weight: 800;
                background: linear-gradient(to right, #fff, #22d3ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .top-nav-links {
                display: flex;
                gap: 0.75rem;
                align-items: center;
            }
            .nav-btn {
                padding: 0.45rem 1.1rem;
                border-radius: 8px;
                font-size: 0.875rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.2s;
                font-family: 'Outfit', sans-serif;
            }
            .nav-btn-ghost {
                color: #94a3b8;
                border: 1px solid rgba(71,85,105,0.4);
                background: transparent;
            }
            .nav-btn-ghost:hover { color: #22d3ee; border-color: rgba(6,182,212,0.4); background: rgba(6,182,212,0.08); }
            .nav-btn-primary {
                color: white;
                background: linear-gradient(135deg, #06b6d4, #0891b2);
                border: 1px solid #06b6d4;
                box-shadow: 0 0 15px rgba(6,182,212,0.3);
            }
            .nav-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 0 25px rgba(6,182,212,0.5); }

            /* Hero */
            .hero {
                position: relative;
                z-index: 10;
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                padding: 5rem 2rem 3rem;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.4rem 1rem;
                background: rgba(6, 182, 212, 0.1);
                border: 1px solid rgba(6, 182, 212, 0.3);
                border-radius: 50px;
                font-size: 0.8125rem;
                font-weight: 600;
                color: #22d3ee;
                margin-bottom: 2rem;
                animation: fadeInUp 0.6s ease-out;
            }

            .hero-icon {
                font-size: 7rem;
                background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 50%, #38bdf8 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                filter: drop-shadow(0 20px 40px rgba(6, 182, 212, 0.5));
                margin-bottom: 1.5rem;
                animation: fadeInScale 1s ease-out, float 4s ease-in-out infinite;
            }

            h1 {
                font-size: 5rem;
                font-weight: 900;
                line-height: 1;
                margin-bottom: 1.25rem;
                text-transform: uppercase;
                letter-spacing: 2px;
                background: linear-gradient(to right, #ffffff 30%, #22d3ee 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                animation: fadeInUp 0.8s ease-out 0.2s backwards;
            }

            .subtitle {
                font-size: 1.375rem;
                font-weight: 300;
                color: #cbd5e1;
                max-width: 650px;
                margin: 0 auto 2.5rem;
                line-height: 1.7;
                animation: fadeInUp 0.8s ease-out 0.4s backwards;
            }

            .cta-group {
                display: flex;
                gap: 1.25rem;
                justify-content: center;
                flex-wrap: wrap;
                animation: fadeInUp 0.8s ease-out 0.6s backwards;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.9rem 2.5rem;
                border-radius: 50px;
                font-weight: 700;
                font-size: 1rem;
                text-decoration: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                letter-spacing: 0.5px;
                position: relative;
                overflow: hidden;
                font-family: 'Outfit', sans-serif;
            }
            .btn::before {
                content: '';
                position: absolute;
                top: 0; left: -100%;
                width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
                transition: left 0.5s;
            }
            .btn:hover::before { left: 100%; }

            .btn-primary {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
                color: #fff;
                box-shadow: 0 0 25px rgba(6, 182, 212, 0.4);
                border: 2px solid #06b6d4;
            }
            .btn-primary:hover {
                transform: translateY(-4px) scale(1.02);
                box-shadow: 0 0 45px rgba(34, 211, 238, 0.7);
                border-color: #22d3ee;
            }
            .btn-secondary {
                background: rgba(255,255,255,0.05);
                color: #e2e8f0;
                border: 2px solid rgba(255,255,255,0.2);
                backdrop-filter: blur(10px);
            }
            .btn-secondary:hover {
                background: rgba(34, 211, 238, 0.1);
                border-color: #22d3ee;
                color: #22d3ee;
                transform: translateY(-4px) scale(1.02);
                box-shadow: 0 0 20px rgba(34, 211, 238, 0.3);
            }

            /* Feature cards */
            .features {
                position: relative;
                z-index: 10;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.25rem;
                max-width: 900px;
                margin: 3rem auto 0;
                padding: 0 2rem;
                animation: fadeInUp 0.8s ease-out 0.8s backwards;
            }
            .feature-card {
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(71, 85, 105, 0.3);
                border-radius: 16px;
                padding: 1.5rem;
                text-align: center;
                transition: all 0.3s;
            }
            .feature-card:hover {
                border-color: rgba(34, 211, 238, 0.4);
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(6, 182, 212, 0.15);
                background: rgba(15, 23, 42, 0.85);
            }
            .feature-icon {
                font-size: 2rem;
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                margin-bottom: 0.75rem;
                display: block;
            }
            .feature-title {
                font-size: 1rem;
                font-weight: 700;
                color: #e2e8f0;
                margin-bottom: 0.4rem;
            }
            .feature-desc {
                font-size: 0.8125rem;
                color: #64748b;
                line-height: 1.5;
            }

            /* Footer */
            .footer {
                position: relative;
                z-index: 10;
                padding: 1.75rem 2rem;
                background: rgba(8, 10, 25, 0.6);
                backdrop-filter: blur(10px);
                border-top: 1px solid rgba(255,255,255,0.07);
                margin-top: 4rem;
            }
            .footer-content {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
            }
            .footer-text { font-size: 0.875rem; color: rgba(255,255,255,0.5); }
            .footer-brand {
                font-weight: 700;
                background: linear-gradient(to right, #06b6d4, #22d3ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeInScale {
                from { opacity: 0; transform: scale(0.5); }
                to { opacity: 1; transform: scale(1); }
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-18px); }
            }

            @media (max-width: 768px) {
                .top-nav { padding: 1rem; }
                .hero-icon { font-size: 5rem; }
                h1 { font-size: 3rem; }
                .subtitle { font-size: 1.125rem; }
                .cta-group { flex-direction: column; align-items: center; }
                .btn { width: 100%; max-width: 280px; justify-content: center; }
                .features { grid-template-columns: 1fr; max-width: 380px; }
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Particles -->
        <div class="particles" id="particles"></div>

        <!-- Top Nav -->
        <nav class="top-nav">
            <a href="{{ url('/') }}" class="top-nav-brand">
                <i class="ti ti-shield-check-filled"></i>
                <span>eWitnessVault</span>
            </a>
            <div class="top-nav-links">
                <a href="{{ route('about') }}" class="nav-btn nav-btn-ghost">About</a>
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-ghost">Sign In</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Get Started</a>
                @endif
            </div>
        </nav>

        <!-- Hero -->
        <div class="hero">
            <div class="hero-badge">
                <i class="ti ti-lock"></i>
                Military-Grade AES-256 Encryption
            </div>
            <i class="ti ti-shield-check-filled hero-icon"></i>
            <h1>eWitnessVault</h1>
            <p class="subtitle">The definitive platform for secure, tamper-proof digital evidence. Preserving truth with immutable technology.</p>

            <div class="cta-group">
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="ti ti-rocket"></i>
                    Get Started Free
                </a>
                <a href="{{ route('about') }}" class="btn btn-secondary">
                    <i class="ti ti-info-circle"></i>
                    Learn More
                </a>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="features">
            <div class="feature-card">
                <i class="ti ti-shield-lock feature-icon"></i>
                <div class="feature-title">Tamper-Proof</div>
                <div class="feature-desc">SHA-256 hashing ensures every file is verifiably authentic</div>
            </div>
            <div class="feature-card">
                <i class="ti ti-certificate feature-icon"></i>
                <div class="feature-title">Court-Admissible</div>
                <div class="feature-desc">Complete chain of custody with cryptographic audit trails</div>
            </div>
            <div class="feature-card">
                <i class="ti ti-users-group feature-icon"></i>
                <div class="feature-title">Role-Based Access</div>
                <div class="feature-desc">Judges, Lawyers, and Investigators — each with tailored access</div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-text">&copy; {{ date('Y') }} eWitnessVault &mdash; Your digital evidence, protected.</div>
                <div class="footer-text">Designed by <span class="footer-brand">Tinka</span></div>
            </div>
        </footer>

        <script>
            // Register Service Worker for PWA
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js').then(reg => {
                        console.log('SW Registered');
                    }).catch(err => console.log('SW Error', err));
                });
            }

            // Generate floating particles
            const container = document.getElementById('particles');
            for (let i = 0; i < 25; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                p.style.left = Math.random() * 100 + '%';
                p.style.animationDuration = (8 + Math.random() * 12) + 's';
                p.style.animationDelay = (Math.random() * 10) + 's';
                p.style.setProperty('--drift', (Math.random() * 100 - 50) + 'px');
                p.style.width = p.style.height = (2 + Math.random() * 3) + 'px';
                p.style.opacity = (0.3 + Math.random() * 0.5).toString();
                container.appendChild(p);
            }
        </script>
    </body>
</html>
