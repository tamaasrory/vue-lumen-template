const path = '/user'
const permission = 'user-'
const routeName = 'user'
const folder = 'user'
const title = 'User'
const User = [
  {
    path: path,
    component: () => import(/* webpackChunkName: "[request].chunk" */ `@/views/${folder}/Main`),
    meta: {
      title: title,
      icon: 'mdi-account-circle-outline',
      // subheader: '-',
      requiresAuth: true,
      requirePermission: permission + 'list'
    },
    children: [
      {
        path: 'index',
        name: routeName,
        component: () => import(/* webpackChunkName: "[request].chunk" */ `@/views/${folder}/Index`),
        meta: {
          title: title,
          icon: 'mdi-minus',
          // subheader: '-',
          requiresAuth: true,
          requirePermission: permission + 'list'
        }
      },
      {
        path: 'baru',
        name: routeName + '_add',
        component: () => import(/* webpackChunkName: "[request].baru.chunk" */ `@/views/${folder}/Add`),
        meta: {
          title: 'Tambah ' + title,
          icon: 'mdi-minus',
          requiresAuth: true,
          requirePermission: permission + 'create'
        }
      },
      {
        path: 'view/:id',
        name: routeName + '_view',
        component: () => import(/* webpackChunkName: "[request].view.chunk" */ `@/views/${folder}/View`),
        props: true,
        meta: {
          title: 'Detail ' + title,
          // icon: 'mdi-minus',
          requiresAuth: true,
          requirePermission: permission + 'list'
        }
      },
      {
        path: 'edit/:id',
        name: routeName + '_edit',
        component: () => import(/* webpackChunkName: "[request].edit.chunk" */ `@/views/${folder}/Edit`),
        props: true,
        meta: {
          title: 'Edit ' + title,
          // icon: 'mdi-minus',
          requiresAuth: true,
          requirePermission: permission + 'edit'
        }
      }
    ]
  }
]

export default User
