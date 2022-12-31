//
// Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
// website : https://tamaasrory.com
// email : tamaasrory@gmail.com
//

module.exports = {
  transpileDependencies: [
    'vuetify'
  ],
  devServer: {
    // port,
    // host,
    // https: true,
    headers: {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
      'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization'
    }
  },
  pwa: {
    name: 'SIM Tahsin',
    themeColor: '#0288D1',
    msTileColor: '#FFFFFF',
    appleMobileWebAppCapable: 'yes',
    appleMobileWebAppStatusBarStyle: 'default',
    manifestPath: 'manifest.json',
    manifestOptions: {
      icons: [
        {
          src: '/img/icons/android-icon-36x36.png',
          sizes: '36x36',
          type: 'image/png',
          density: '0.75'
        },
        {
          src: '/img/icons/android-icon-48x48.png',
          sizes: '48x48',
          type: 'image/png',
          density: '1.0'
        },
        {
          src: '/img/icons/android-icon-72x72.png',
          sizes: '72x72',
          type: 'image/png',
          density: '1.5'
        },
        {
          src: '/img/icons/android-icon-96x96.png',
          sizes: '96x96',
          type: 'image/png',
          density: '2.0'
        },
        {
          src: '/img/icons/android-icon-144x144.png',
          sizes: '144x144',
          type: 'image/png',
          density: '3.0'
        },
        {
          src: '/img/icons/android-icon-192x192.png',
          sizes: '192x192',
          type: 'image/png',
          density: '4.0'
        }
      ],
      background_color: '#FFFFFF'
    },
    iconPaths: {
      faviconSVG: null,
      favicon32: 'img/icons/favicon-32x32.png',
      favicon16: 'img/icons/favicon-16x16.png',
      appleTouchIcon: 'img/icons/apple-icon-152x152.png',
      maskIcon: 'img/icons/android-icon-192x192.png',
      msTileImage: 'img/icons/ms-icon-150x150.png'
    },
    workboxOptions: { skipWaiting: true }
    // workboxPluginMode: 'InjectManifest',
    // workboxOptions: {
    //   // skipWaiting: true,
    //   swSrc: 'src/service-worker.js' // CHECK CORRECT PATH!
    // }
  },
  lintOnSave: false
}
