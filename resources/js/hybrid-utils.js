/**
 * eWitnessVault — Hybrid App Utilities
 * PWA Install Prompt, Bottom Nav, Network Status, and Touch Enhancements
 */

// ─── PWA INSTALL PROMPT ──────────────────────────────────────────
let deferredPrompt = null;

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    showInstallBanner();
});

function showInstallBanner() {
    // Don't show if already installed or dismissed
    if (window.matchMedia('(display-mode: standalone)').matches) return;
    if (sessionStorage.getItem('pwa-install-dismissed')) return;

    const banner = document.createElement('div');
    banner.id = 'pwa-install-banner';
    banner.innerHTML = `
        <div class="pwa-banner-content">
            <div class="pwa-banner-icon">
                <img src="/images/logo-192.png" alt="eWitnessVault" width="40" height="40" style="border-radius: 10px;">
            </div>
            <div class="pwa-banner-text">
                <div class="pwa-banner-title">Install eWitnessVault</div>
                <div class="pwa-banner-subtitle">Quick access & offline support</div>
            </div>
            <div class="pwa-banner-actions">
                <button class="pwa-btn-install" onclick="installPWA()">Install</button>
                <button class="pwa-btn-dismiss" onclick="dismissInstallBanner()" aria-label="Dismiss">&times;</button>
            </div>
        </div>
    `;
    document.body.appendChild(banner);

    // Animate in
    requestAnimationFrame(() => {
        banner.classList.add('pwa-banner-visible');
    });
}

function installPWA() {
    if (!deferredPrompt) return;
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then(choice => {
        if (choice.outcome === 'accepted') {
            console.log('[PWA] User accepted install');
        }
        deferredPrompt = null;
        dismissInstallBanner();
    });
}

function dismissInstallBanner() {
    const banner = document.getElementById('pwa-install-banner');
    if (banner) {
        banner.classList.remove('pwa-banner-visible');
        setTimeout(() => banner.remove(), 400);
    }
    sessionStorage.setItem('pwa-install-dismissed', 'true');
}

// ─── NETWORK STATUS TOAST ────────────────────────────────────────
let wasOffline = !navigator.onLine;

function showNetworkToast(isOnline) {
    // Remove any existing toast
    const existing = document.getElementById('network-toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.id = 'network-toast';
    toast.className = isOnline ? 'network-toast online' : 'network-toast offline';
    toast.innerHTML = `
        <span class="network-toast-dot ${isOnline ? 'dot-online' : 'dot-offline'}"></span>
        <span>${isOnline ? 'Connection Restored' : 'You are offline'}</span>
    `;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.add('toast-visible');
    });

    setTimeout(() => {
        toast.classList.remove('toast-visible');
        setTimeout(() => toast.remove(), 400);
    }, 3000);
}

window.addEventListener('online', () => {
    if (wasOffline) {
        showNetworkToast(true);
    }
    wasOffline = false;
});

window.addEventListener('offline', () => {
    wasOffline = true;
    showNetworkToast(false);
});

// ─── PULL TO REFRESH (Mobile Enhancement) ────────────────────────
let touchStartY = 0;
let isPulling = false;

document.addEventListener('touchstart', (e) => {
    if (window.scrollY === 0) {
        touchStartY = e.touches[0].clientY;
    }
}, { passive: true });

document.addEventListener('touchmove', (e) => {
    if (window.scrollY === 0 && e.touches[0].clientY > touchStartY + 80 && !isPulling) {
        isPulling = true;
    }
}, { passive: true });

document.addEventListener('touchend', () => {
    if (isPulling) {
        window.location.reload();
    }
    isPulling = false;
    touchStartY = 0;
});

// ─── HAPTIC FEEDBACK (for native) ────────────────────────────────
function hapticFeedback(type = 'LIGHT') {
    if (window.triggerHaptic) {
        window.triggerHaptic(type);
    } else if (navigator.vibrate) {
        switch (type) {
            case 'SUCCESS': navigator.vibrate([10, 50, 10]); break;
            case 'WARNING': navigator.vibrate([30, 20, 30]); break;
            default: navigator.vibrate(10);
        }
    }
}

// Add haptic to all links and buttons
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a, button, .action-card').forEach(el => {
        el.addEventListener('click', () => hapticFeedback('LIGHT'));
    });
});

// ─── VIEWPORT HEIGHT FIX (Mobile Browsers) ───────────────────────
function setVH() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}
setVH();
window.addEventListener('resize', setVH);

// ─── APP UPDATE NOTIFICATION ─────────────────────────────────────
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.addEventListener('controllerchange', () => {
        const updateBar = document.createElement('div');
        updateBar.id = 'update-bar';
        updateBar.innerHTML = `
            <div class="update-bar-content">
                <span>🔄 A new version is available</span>
                <button onclick="window.location.reload()" class="update-btn">Update Now</button>
            </div>
        `;
        document.body.appendChild(updateBar);
        requestAnimationFrame(() => updateBar.classList.add('update-visible'));
    });
}
