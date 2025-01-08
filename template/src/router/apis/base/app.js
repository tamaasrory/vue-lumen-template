export default {
  toggleMainMenu ({ commit }, payload) {
    localStorage.setItem('toggleMainMenu', payload)
  }
}
