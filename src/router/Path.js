/*
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

export const baseURL = process.env.VUE_APP_BASEURL
export const APPNAME = process.env.VUE_APP_NAME
export const asset = (v) => process.env.VUE_APP_BASEURL + `/api/v1/images?f=${v}`
