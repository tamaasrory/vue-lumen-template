import $axios from '@/router/server'

export default {
  logout ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      $axios.post('/auth/logout', payload)
        .then((response) => {
          commit('SET_TOKEN', null)
          commit('SET_USER', {})
          commit('SET_PERM', [])
          // commit('SET_COMMAND', null)
          resolve(response)
        })
        .catch((error) => {
          resolve(error)
        })
    })
  },
  login ({ commit }, payload) {
    commit('SET_TOKEN', null)
    commit('SET_USER', null)
    commit('SET_PERM', [])

    return new Promise((resolve, reject) => {
      $axios.post('/auth/login', payload)
        .then((response) => {
          const { data, status } = response

          if (status === 200) {
            if (data.value) {
              commit('SET_TOKEN', data.token)
              commit('SET_USER', data.value)
              commit('SET_PERM', data.value.perm)
            } else {
              commit('SET_ERRORS', { message: data.msg })
            }
          }
          resolve(response)
        })
        .catch((error) => {
          commit('SET_ERRORS', { message: error })
          resolve(error)
        })
    })
  },
  authRefresh ({ commit }) {
    return new Promise((resolve, reject) => {
      $axios.get('/auth/refresh')
        .then((response) => {
          const { data, status } = response

          if (status === 200) {
            commit('SET_PERM', data.value)
            resolve(data.value)
          }
          resolve([])
        })
        .catch((error) => {
          console.log(error)
          commit('SET_ERRORS', { message: error })
          resolve([])
        })
    })
  }
}
