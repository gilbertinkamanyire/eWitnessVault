/**
 * eWitnessVault Hybrid Mobile Bridge
 * Handles Capacitor Native Integrations
 */

document.addEventListener('DOMContentLoaded', async () => {
    if (window.Capacitor && window.Capacitor.isNative) {
        const { StatusBar, SplashScreen, Haptics, Network } = window.Capacitor.Plugins;

        // 1. Configure Status Bar
        try {
            if (StatusBar) {
                await StatusBar.setStyle({ style: 'DARK' });
                await StatusBar.setBackgroundColor({ color: '#0f172a' }); // Match app theme
            }
        } catch (e) { console.warn('StatusBar Plugin not available'); }

        // 2. Handle Splash Screen
        try {
            if (SplashScreen) {
                setTimeout(async () => {
                    await SplashScreen.hide();
                }, 1000);
            }
        } catch (e) { console.warn('SplashScreen Plugin not available'); }

        // 3. Network Monitoring
        try {
            if (Network) {
                Network.addListener('networkStatusChange', status => {
                    if (!status.connected) {
                        alert('You are offline. Evidence uploads will be queued.');
                    }
                });
            }
        } catch (e) { console.warn('Network Plugin not available'); }

        // 4. Haptic Feedback for critical actions
        window.triggerHaptic = async (type = 'LIGHT') => {
            if (Haptics) {
                try {
                    if (type === 'SUCCESS') await Haptics.notification({ type: 'SUCCESS' });
                    else if (type === 'WARNING') await Haptics.notification({ type: 'WARNING' });
                    else await Haptics.impact({ style: 'LIGHT' });
                } catch (e) {}
            }
        };

        console.log('eWitnessVault Hybrid Bridge Activated');
    } else {
        window.triggerHaptic = () => {}; // No-op for web
    }
});
