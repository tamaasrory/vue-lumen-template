/*
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

import axios from 'axios'
import { baseURL } from './Path'
import store from '../store'

const $axios = axios.create({
  baseURL: `${baseURL}/api/v1`,
  headers: { 'Content-Type': 'application/json' }
})

$axios.interceptors.request.use(
  (config) => {
    // const token = localStorage.getItem('token')
    const token = store.state.token

    if (token) {
      config.headers.Authorization = `Bearer ${token}`
      // console.log('token on request = ' + token)
    }

    return config
  },

  (error) => {
    return Promise.reject(error)
  }
)

export default $axios
