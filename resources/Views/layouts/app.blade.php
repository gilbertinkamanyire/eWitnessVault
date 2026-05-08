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
        <meta name="mobile-web-app-capable" content="yes">
        
        <!-- Security Headers -->
        <meta http-equiv="X-Content-Type-Options" content="nosniff">
        <meta name="referrer" content="strict-origin-when-cross-origin">
        
        <link rel="manifest" href="/manifest.json">
        <link rel="apple-touch-icon" href="/images/logo-192.png">

        <title>{{ config('app.name', 'eWitnessVault') }} | Secure Digital Evidence Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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

            // PWA standalone detection
            if (window.matchMedia('(display-mode: standalone)').matches) {
                document.documentElement.classList.add('pwa-standalone');
            }

            // Service Worker Registration
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js').then(reg => {
                        console.log('SW registered:', reg);
                    }).catch(err => {
                        console.log('SW registration failed:', err);
                    });
                });
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased {{ request()->is('admin*') ? 'admin-dashboard' : '' }}">
        <div class="app-container min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="header-modern shadow-lg" style="position: relative; z-index: 50;">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="content-wrapper max-w-7xl mx-auto">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="app-footer">
                <div class="footer-content">
                    <div class="footer-text">
                        &copy; {{ date('Y') }} eWitnessVault &mdash; Your digital evidence, protected.
                    </div>
                    <div class="footer-links" style="margin-left: auto;">
                        <span class="footer-text">Designed by <span class="footer-brand">Tinka</span></span>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Mobile Bottom Navigation -->
        @auth
            @include('components.bottom-nav')
        @endauth
    </body>
</html>
