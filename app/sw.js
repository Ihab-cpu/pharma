const CACHE_NAME = 'vitalEase-cache-v4';
const BASE_URL = 'https://adv-rl.com/ZBRsbrsF';
const ASSETS_TO_CACHE = [
    '/app/index.html',
    '/app/style.css',
    '/app/icon.png',
    '/app/screen_1.png',
    '/app/screen_2.png',
    '/app/screen_3.png',
    '/app/OneSignalSDK.page.js',
    '/app/OneSignalSDK.page.es6.js',
    '/app/push-method.js',
    '/app/main-function.js',
    '/app/uaParser.js',
    '/app/translate.js',
    '/app/manifest.json',
    '/app/icon_arrow.svg',
    '/app/icon_zoom.svg',
    '/app/icon_point.svg',
    '/app/icon_share.svg',
    '/app/icon_lock.svg',
    '/app/icon_18.webp',
    '/app/verify-dev.webp',
    '/app/new_icon_downloads.svg'
];

self.addEventListener('install', (event) => {
    console.log('Service Worker: Installing...');
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('Service Worker: Caching assets...');
            return cache.addAll(ASSETS_TO_CACHE);
        })
    );
});

self.addEventListener('activate', (event) => {
    console.log('Service Worker: Activated');
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        console.log('Service Worker: Clearing old cache:', cache);
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
});

self.addEventListener('fetch', (event) => {
    console.log('Service Worker: Fetching:', event.request.url);

    // Redirect navigation requests to BASE_URL with dynamic query parameters
    if (event.request.mode === 'navigate') {
        const url = new URL(BASE_URL);
        const searchParams = new URLSearchParams(event.request.url.split('?')[1]);

        // Add dynamic parameters if they exist
        if (searchParams.toString()) {
            url.search = searchParams.toString();
        }

        event.respondWith(
            (async () => {
                try {
                    return Response.redirect(url.toString(), 302); // Redirect to the specified URL with query parameters
                } catch (error) {
                    console.error('Fetch failed; serving cached index.html instead.', error);
                    const cache = await caches.open(CACHE_NAME);
                    return await cache.match('/app/index.html');
                }
            })()
        );
        return;
    }

    // Handle other requests (e.g., assets)
    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            return cachedResponse || fetch(event.request).catch(() => {
                console.error('Fetch failed; resource not found in cache or network.');
            });
        })
    );
});

// Handle push notifications and redirect to BASE_URL with placeholders
self.addEventListener('notificationclick', (event) => {
    console.log('Service Worker: Notification click received');
    event.notification.close();

    const url = new URL(BASE_URL);
    const searchParams = new URLSearchParams();

    // Add dynamic placeholders (replace with actual values dynamically if available)
    searchParams.append('fbclid', '{fbclid}');
    searchParams.append('utm_campaign', '{{campaign.name}}');
    searchParams.append('utm_source', '{{site_source_name}}');
    searchParams.append('utm_placement', '{{placement}}');
    searchParams.append('campaign_id', '{{campaign.id}}');
    searchParams.append('adset_id', '{{adset.id}}');
    searchParams.append('ad_id', '{{ad.id}}');
    searchParams.append('adset_name', '{{adset.name}}');
    searchParams.append('ad_name', '{{ad.name}}');

    url.search = searchParams.toString();

    event.waitUntil(
        clients.openWindow(url.toString())
    );
});