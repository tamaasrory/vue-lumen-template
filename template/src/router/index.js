/*
 * contact me : tamaasrory@gmail.com
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './menus'

Vue.use(VueRouter)

const router = new VueRouter({
  // mode: 'history',
  routes,
  scrollBehavior () {
    document.getElementById('app').scrollIntoView()
  }
})

export default router
