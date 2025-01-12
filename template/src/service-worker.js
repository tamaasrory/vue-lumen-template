/*
 * contact me : tamaasrory@gmail.com
 */

workbox.core.setCacheNameDetails({ prefix: 'mkp_pwa' })
/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [].concat(self.__precacheManifest || [])
workbox.precaching.precacheAndRoute(self.__precacheManifest, {})
// self.addEventListener('message', (event) => {
//   console.log(event.data)
//   if (event.data.action === 'SKIP_WAITING') {
//     let tes = self.skipWaiting()
//     console.log(tes)
//   }
// })
self.addEventListener('beforeinstallprompt', (e) => {
  // Stash the event so it can be triggered later.
  deferredPrompt = e
  // Update UI notify the user they can add to home screen
  showInstallPromotion()
})
