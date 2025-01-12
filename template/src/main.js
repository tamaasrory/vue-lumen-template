
/*
 * contact me : tamaasrory@gmail.com
 */

import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import VueMoment from 'vue-moment'
import LoadScript from 'vue-plugin-load-script'
import Viewer from 'v-viewer'

import 'viewerjs/dist/viewer.css'
import '@/assets/cui.css'
import '@mdi/font/css/materialdesignicons.min.css'
import { isEmpty } from '@/plugins/supports'

const moment = require('moment')
require('moment/locale/id')
Vue.config.productionTip = false

Vue.use(LoadScript)
Vue.use(Viewer)

Vue.use(VueMoment, {
  moment
})

Vue.mixin({
  methods: {
    can: (permissions, condition = true) => {
      // console.log('condition => ', condition, ' permissions => ', JSON.stringify(permissions))
      for (const permission of permissions) {
        if (store.getters.perm.includes(permission)) {
          if (condition) {
            return true
          } else {
            return false
          }
        }
      }
      return false
    }
  }
})

// Navigation Guards
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const auth = store.getters.isAuth
    if (!auth) {
      next({ name: 'login' })
    } else {
      const perm = store.getters.perm || []
      if (!isEmpty(perm)) {
        if (to.matched.some(record => {
          if (perm.includes(record.meta.requirePermission)) {
            return true
          }
          return false
        })) {
          next()
        }
      } else {
        next({ name: 'not_found' })
      }
    }
  } else {
    next()
  }
})

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
