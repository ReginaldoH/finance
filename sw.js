const CACHE_NAME = 'simulador-v2.0'; // altere a versão a cada atualização
const FILES_TO_CACHE = [
  './simulador.php'
];

self.addEventListener('install', event => {
  console.log('[Service Worker] Instalando nova versão...');
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(FILES_TO_CACHE);
    })
  );
  self.skipWaiting(); // força ativação imediata da nova versão
});

self.addEventListener('activate', event => {
  console.log('[Service Worker] Limpando caches antigos...');
  event.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(
        keys
          .filter(key => key !== CACHE_NAME)
          .map(key => caches.delete(key))
      );
    })
  );
  self.clients.claim(); // atualiza todas as abas abertas
});

self.addEventListener('fetch', event => {
  if (event.request.url.includes('manifest.json')) {
    // sempre buscar manifest novo
    event.respondWith(fetch(event.request));
  } else {
    event.respondWith(
      caches.match(event.request).then(response => {
        return response || fetch(event.request);
      })
    );
  }
});
