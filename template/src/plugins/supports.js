/*
 * contact me : tamaasrory@gmail.com
 */
import { asset } from '@/router/Path'
import $axios from '@/router/server'
import store from '../store'

/**
 * callBack function<br>
 * r = result dari pemeriksaan bernilai true (bila value kosong) dan<br>
 * bernilai false (bila value tidak kosong)<br>
 *
 * v = value original yang di periksa<br>
 * <code>(r, v) => (r ? [] : v)</code><br>
 */
export const isEmpty = (v, callBack) => {
  let result = false

  if (['null', null].includes(v)) {
    result = true
  } else {
    switch (typeof v) {
      case 'object':
        switch (v.constructor.name) {
          case 'Object':result = !Object.keys(v).length
            break
          case 'Array':result = !v.length
            break
          default:result = false
        }
        break
      case 'string':
        result = !v.length
        break
      case 'boolean':
        result = !v
        break
      case 'undefined':
        result = true
        break
    }
  }

  if (typeof callBack === 'function') {
    result = callBack(result, v)
  }
  if (typeof callBack !== 'function' && typeof callBack !== 'undefined') {
    result = result ? callBack : v
  }
  return result
}

/**
 * if "valid" return false,
 * if "not valid" return true
 * @param schema
 * @param rules
 * @param data
 * @returns {boolean}
 */
export const inputValidator = (schema, rules, data, trigger) => {
  let notValid = false
  Object.keys(schema).map(key => {
    // split method untuk verifikasi
    const _key = key.includes('.') ? key.split('.') : key
    const funs = schema[key].split('|')
    // console.log(funs)
    for (let i = 0; i < funs.length; i++) {
      const valid = rules[funs[i]](typeof _key === 'string'
        ? data[_key]
        : data[_key[0]][_key[1]])
      // console.log(valid)
      if (typeof valid === 'string') {
        notValid = true
        break
      }
    }
    return null
  })
  return notValid
}

export const imgUrlToBlob = (imgUrl, callback) => {
  const tmp = new Promise((resolve, reject) => {
    $axios.get(asset(imgUrl))
      .then((response) => {
        if (response.status === 200) {
          resolve(response.data)
        } else {
          resolve(response.data)
        }
      })
      .catch((error) => {
        console.log(error)
        resolve([])
      })
  })
  tmp.then(d => {
    fetch(d).then(res => res.blob()).then(res => callback(res)).finally(() => {
      setTimeout(() => {
      }, 1500)
    })
  })
}

export const dataFilter = (word, datas, callback) => {
  if (!isEmpty(word)) {
    const tmp = []
    datas.map(v => {
      if (callback(v)) {
        tmp.push(v)
      }
      return null
    })
    return tmp
  } else {
    return datas
  }
}

export const can = (permissions) => {
  for (const permission of permissions) {
    if (store.getters.perm.includes(permission)) {
      return true
    }
  }
  return false
}

export const toRupiah = (number) => {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
  }).format(number)
}
