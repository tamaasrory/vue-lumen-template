/*
 * contact me : tamaasrory@gmail.com
 */

import auth from './apis/base/auth'
import roles from './apis/base/roles'
import user from './apis/base/user'
import app from './apis/base/app'
import Permissions from './apis/base/permissions'
// {{next_import}}

const $api = {
  ...auth,
  ...roles,
  ...user,
  ...app,
  ...Permissions// {{next_use}}
}

export default $api
