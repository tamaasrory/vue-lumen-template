/*
 * contact me : tamaasrory@gmail.com
 */

/* eslint-disable no-console */

import { register } from 'register-service-worker'

if (process.env.NODE_ENV === 'production') {
  register(`${process.env.BASE_URL}service-worker.js`, {
    ready () {
      console.log(
        'App is being served from cache by a service worker.\n' +
        'For more details, visit https://goo.gl/AFskqB'
      )
    },
    registered () {
      console.log('Service worker has been registered.')
    },
    cached () {
      console.log('Content has been cached for offline use.')
    },
    updatefound () {
      console.log('New content is downloading...')
    },
    updated (registration) {
      // if (window.confirm('A new version is available, update now?')) {
      //   const worker = registration.waiting
      //   console.log(worker)
      //   worker.postMessage({ action: 'SKIP_WAITING' })
      //   // refresh the page or trigger a refresh programatically!
      // }
      console.log('New content is available: Please refresh.')
      window.location.reload()
    },
    offline () {
      console.log('No internet connection found. App is running in offline mode.')
    },
    error (error) {
      console.error('Error during service worker registration:', error)
    }
  })
}
