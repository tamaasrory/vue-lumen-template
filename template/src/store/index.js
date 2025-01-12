/*
 * contact me : tamaasrory@gmail.com
 */

import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import SecureLS from 'secure-ls'
import $api from '../router/api'
import $mutations from './mutations'
import $getters from './getters'
import $states from './states'

const ls = new SecureLS({ isCompression: false })

Vue.use(Vuex)

const store = new Vuex.Store({
  state: $states,
  getters: $getters,
  mutations: $mutations,
  actions: $api,
  plugins: [
    createPersistedState({
      storage: {
        getItem: key => ls.get(key),
        setItem: (key, value) => ls.set(key, value),
        removeItem: key => ls.remove(key)
      }
    })
  ]
})

export default store
