import * as firebase from 'firebase'
import 'firebase/database'

const config = {
  apiKey: '-',
  authDomain: '-',
  projectId: '-',
  storageBucket: '-',
  messagingSenderId: '-',
  appId: '-'
}

firebase.initializeApp(config)

export default firebase.database()
