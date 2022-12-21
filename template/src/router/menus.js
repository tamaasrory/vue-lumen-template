/*
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */
import User from './menus/base/user'
import Roles from './menus/base/roles'
import Permissions from './menus/base/permissions'
// {{next_import}}

const baseMenu = [
  {
    path: '/',
    name: 'home',
    component: () => import(/* webpackChunkName: "home.chunk" */ '@/views/Home'),
    meta: {
      title: 'Dashboard',
      icon: 'mdi-view-dashboard-outline',
      requirePermission: 'home',
      requiresAuth: true
    }
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login.chunk" */ '@/views/Login'),
    meta: {
      title: 'Login'
    }
  },
  {
    path: '*',
    name: 'not_found',
    component: () => import(/* webpackChunkName: "notfound.chunk" */ '@/views/NotFound'),
    meta: {
      title: 'Not Found'
    }
  }
]

export const routes = baseMenu.concat(
  User,
  Roles,
  Permissions// {{next_use}}
)

export const menus = baseMenu.concat(
  [{ subheader: 'Data Master' }],
  User,
  Roles,
  Permissions// {{next_use}}
)
