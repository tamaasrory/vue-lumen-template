/*
 * contact me : tamaasrory@gmail.com
 */

export const baseURL = process.env.VUE_APP_BASEURL
export const APPNAME = process.env.VUE_APP_NAME
export const asset = (v) => process.env.VUE_APP_BASEURL + `/api/v1/images?f=${v}`
