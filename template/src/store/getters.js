/*
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

const $getters = {
  // KITA MEMBUAT SEBUAH GETTERS DENGAN NAMA isAuth
  // DIMANA GETTERS INI AKAN BERNILAI TRUE/FALSE DENGAN KONDISI BERDASARKAN
  // STATE token.
  isAuth: state => {
    return (state.token !== 'null' && state.token != null) && (!!state.user) && (!!state.perm)
  },
  perm: state => {
    return state.perm
  }
}

export default $getters
