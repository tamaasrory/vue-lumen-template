/*
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

const $mutations = {
  SET_TOKEN (state, payload) {
    state.token = payload
  },
  SET_DRAWER (state, payload) {
    state.toggleMainMenu = payload
  },
  SET_DATA_TMP (state, payload) {
    state.dataTmp = payload
  },
  SET_USER (state, payload) {
    state.user = payload
  },
  SET_PERM (state, payload) {
    state.perm = payload
  },
  CLEAR_USER (state) {
    state.user = {}
  },
  SET_ERRORS (state, payload) {
    state.errors = payload
  },
  CLEAR_ERRORS (state) {
    state.errors = []
  }
}

export default $mutations
