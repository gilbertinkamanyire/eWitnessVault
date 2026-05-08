/**
 * eWitnessVault — Enhanced Service Worker v2
 * Advanced caching strategies, offline support, and background sync readiness
 */

const CACHE_VERSION = 'v2';
const STATIC_CACHE = `ewitness-static-${CACHE_VERSION}`;
const DYNAMIC_CACHE = `ewitness-dynamic-${CACHE_VERSION}`;
const OFFLINE_PAGE = '/offline.html';

// Core assets to pre-cache during install
const PRECACHE_ASSETS = [
  '/',
  OFFLINE_PAGE,
  '/images/logo-192.png',
  '/images/logo-512.png',
  '/images/home-bg.png',
  'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap',
  'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css'
];

// Routes that should always go to network first (dynamic data)
const NETWORK_FIRST_ROUTES = [
  '/dashboard',
  '/evidence',
  '/upload',
  '/admin',
  '/profile',
  '/api/'
];

// Routes that should never be cached
const NO_CACHE_ROUTES = [
  '/login',
  '/register',
  '/logout',
  '/sanctum/',
  '/csrf-token'
];

// ─── INSTALL ─────────────────────────────────────────────────────
self.addEventListener('install', event => {
  console.log('[SW] Installing eWitnessVault Service Worker', CACHE_VERSION);
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then(cache => {
        console.log('[SW] Pre-caching static assets');
        return cache.addAll(PRECACHE_ASSETS);
      })
      .then(() => self.skipWaiting())
      .catch(err => {
        console.warn('[SW] Pre-cache partial failure:', err);
        return self.skipWaiting();
      })
  );
});

// ─── ACTIVATE ────────────────────────────────────────────────────
self.addEventListener('activate', event => {
  console.log('[SW] Activating new service worker', CACHE_VERSION);
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames
          .filter(name => name !== STATIC_CACHE && name !== DYNAMIC_CACHE)
          .map(name => {
            console.log('[SW] Deleting old cache:', name);
            return caches.delete(name);
          })
      );
    }).then(() => self.clients.claim())
  );
});

// ─── FETCH HANDLER ───────────────────────────────────────────────
self.addEventListener('fetch', event => {
  const { request } = event;
  const url = new URL(request.url);

  // Skip non-GET requests
  if (request.method !== 'GET') return;

  // Skip chrome-extension and other non-http requests
  if (!url.protocol.startsWith('http')) return;

  // Skip no-cache routes entirely
  if (NO_CACHE_ROUTES.some(route => url.pathname.startsWith(route))) return;

  // For navigation requests (HTML pages), use network-first strategy
  if (request.mode === 'navigate' || request.headers.get('accept')?.includes('text/html')) {
    event.respondWith(networkFirstWithOfflineFallback(request));
    return;
  }

  // For API/dynamic routes, use network-first
  if (NETWORK_FIRST_ROUTES.some(route => url.pathname.startsWith(route))) {
    event.respondWith(networkFirst(request));
    return;
  }

  // For static assets (images, CSS, JS, fonts), use cache-first
  if (isStaticAsset(url.pathname)) {
    event.respondWith(cacheFirst(request));
    return;
  }

  // Default: stale-while-revalidate
  event.respondWith(staleWhileRevalidate(request));
});

// ─── CACHING STRATEGIES ──────────────────────────────────────────

/**
 * Network First with Offline Fallback (for HTML pages)
 */
async function networkFirstWithOfflineFallback(request) {
  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(DYNAMIC_CACHE);
      cache.put(request, response.clone());
    }
    return response;
  } catch {
    const cached = await caches.match(request);
    if (cached) return cached;
    // Return offline page
    const offlinePage = await caches.match(OFFLINE_PAGE);
    return offlinePage || new Response('You are offline. Please check your connection.', {
      status: 503,
      headers: { 'Content-Type': 'text/html' }
    });
  }
}

/**
 * Network First (for dynamic data)
 */
async function networkFirst(request) {
  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(DYNAMIC_CACHE);
      cache.put(request, response.clone());
    }
    return response;
  } catch {
    const cached = await caches.match(request);
    return cached || new Response('Offline', { status: 503 });
  }
}

/**
 * Cache First (for static assets)
 */
async function cacheFirst(request) {
  const cached = await caches.match(request);
  if (cached) return cached;

  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(STATIC_CACHE);
      cache.put(request, response.clone());
    }
    return response;
  } catch {
    return new Response('', { status: 404 });
  }
}

/**
 * Stale While Revalidate
 */
async function staleWhileRevalidate(request) {
  const cached = await caches.match(request);

  const networkFetch = fetch(request).then(response => {
    if (response.ok) {
      caches.open(DYNAMIC_CACHE).then(cache => {
        cache.put(request, response.clone());
      });
    }
    return response;
  }).catch(() => cached);

  return cached || networkFetch;
}

// ─── HELPERS ─────────────────────────────────────────────────────

function isStaticAsset(pathname) {
  return /\.(css|js|png|jpg|jpeg|gif|webp|svg|ico|woff|woff2|ttf|eot)$/i.test(pathname);
}

// ─── BACKGROUND SYNC (Future: Queue evidence uploads when offline) ──
self.addEventListener('sync', event => {
  if (event.tag === 'evidence-upload') {
    console.log('[SW] Background sync: evidence-upload');
    // Future: Process queued evidence uploads
  }
});

// ─── PUSH NOTIFICATIONS (Future) ─────────────────────────────────
self.addEventListener('push', event => {
  const data = event.data ? event.data.json() : {};
  const title = data.title || 'eWitnessVault';
  const options = {
    body: data.body || 'New notification',
    icon: '/images/logo-192.png',
    badge: '/images/logo-192.png',
    vibrate: [100, 50, 100],
    data: {
      url: data.url || '/'
    },
    actions: [
      { action: 'view', title: 'View' },
      { action: 'dismiss', title: 'Dismiss' }
    ]
  };
  event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', event => {
  event.notification.close();
  const url = event.notification.data?.url || '/';
  event.waitUntil(
    clients.openWindow(url)
  );
});
