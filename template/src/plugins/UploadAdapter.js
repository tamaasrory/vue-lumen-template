/*
 * contact me : tamaasrory@gmail.com
 */
import store from '../store'
import $axios from '@/router/server'
var token = store.state.token

export default class UploadAdapter {
  constructor (loader, token) {
    // The file loader instance to use during the upload.
    this.loader = loader
    this.token = token
  }

  // Starts the upload process.
  upload () {
    return this.loader.file
      .then(file => new Promise((resolve, reject) => {
        /* this._initRequest()
        this._initListeners(resolve, reject, file)
        this._sendRequest(file) */
        /* Initialize the form data */
        let formData = new FormData()
        /* Add the form data we need to submit */
        formData.append('image', file)
        $axios.post(`/post/upload`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
          .then((response) => {
            if (response.status === 200) {
              console.log(response)
              resolve({ default: response.data })
            }
          })
          .catch((error) => {
            console.log(error)
            reject(error)
          })
      }))
  }

  // Aborts the upload process.
  abort () {
    if (this.xhr) {
      this.xhr.abort()
    }
  }

  // Initializes the XMLHttpRequest object using the URL passed to the constructor.
  _initRequest () {
    const xhr = this.xhr = new XMLHttpRequest()

    xhr.open('POST', 'https://api.ethanlaundry.com/api/v1/post/upload', true)
    xhr.withCredentials = true
    xhr.setRequestHeader('Authorization', `Bearer ${token}`)
    xhr.responseType = 'json'
  }

  // Initializes XMLHttpRequest listeners.
  _initListeners (resolve, reject, file) {
    const xhr = this.xhr
    const loader = this.loader
    const genericErrorText = `Couldn't upload file: ${file.name}.`

    xhr.addEventListener('error', () => reject(genericErrorText))
    xhr.addEventListener('abort', () => reject())
    xhr.addEventListener('load', () => {
      const response = xhr.response

      if (!response || response.error) {
        return reject(response && response.error ? response.error.message : genericErrorText)
      }

      resolve({
        default: response.url
      })
    })

    if (xhr.upload) {
      xhr.upload.addEventListener('progress', evt => {
        if (evt.lengthComputable) {
          loader.uploadTotal = evt.total
          loader.uploaded = evt.loaded
        }
      })
    }
  }

  // Prepares the data and sends the request.
  _sendRequest (file) {
    // Prepare the form data.
    const data = new FormData()
    data.append('upload', file)

    // Send the request.
    this.xhr.send(data)
  }
}
