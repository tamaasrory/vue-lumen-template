<!--
  - Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
  - website : https://tamaasrory.com
  - email : tamaasrory@gmail.com
  -->

<template>
  <v-app>
    <div
      v-if="isAuth"
      @mouseover="mouseNow = true"
      @mouseleave="mouseNow = false"
    >
      <v-navigation-drawer
        v-model="openNav"
        app
        floating
        mini-variant-width="68"
        :mini-variant.sync="minivar"
        :expand-on-hover="$vuetify.breakpoint.smAndUp ? drawer : false"
        class="nav-mouse-enter"
      >
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title
              class="font-weight-bold text-capitalize text-center"
              style="color: #007bff"
            >
              {{ APPNAME }}
            </v-list-item-title>
          </v-list-item-content>
          <v-list-item-action class="d-none d-md-block">
            <v-icon @click="toggleDrawer">
              {{ drawer ? "mdi-radiobox-blank" : "mdi-record-circle-outline" }}
            </v-icon>
          </v-list-item-action>
        </v-list-item>
        <v-list-item
          class="pr-0 vertical-nav-menu-list"
          style="
            height: 68px !important;
            padding-left: 13px !important;
            margin-top: 0 !important;
            padding-right: 10px !important;
          "
        >
          <v-list-item-icon class="mr-3">
            <v-avatar
              color="#2b92ff"
              size="40"
            >
              <span class="white--text text-h5">
                {{ getUserAvatar }}
              </span>
            </v-avatar>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title
              class="title"
              style="font-size: 15px !important; white-space: nowrap !important"
            >
              {{ getUserName }}
            </v-list-item-title>
            <v-list-item-subtitle
              style="
                word-wrap: normal !important;
                white-space: nowrap !important;
                font-size: 14px;
                text-transform: capitalize !important;
              "
            >
              {{ getUserRole }}
            </v-list-item-subtitle>
          </v-list-item-content>
          <v-list-item-action>
            <v-menu
              bottom
              left
            >
              <template #activator="{ on, attrs }">
                <v-btn
                  icon
                  class="float-right"
                  v-bind="attrs"
                  v-on="on"
                >
                  <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
              </template>

              <v-list>
                <v-list-item>
                  <v-list-item-title style="cursor: pointer">
                    Profile
                  </v-list-item-title>
                </v-list-item>
                <v-list-item>
                  <v-list-item-title
                    style="cursor: pointer"
                    @click="showDialogLogout = true"
                  >
                    Logout
                  </v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </v-list-item-action>
        </v-list-item>

        <v-divider />
        <v-list
          expand
          shaped
          class="pb-16"
        >
          <dynamic-menu
            :menus="items"
            :is-mini="minivar"
          />
        </v-list>
      </v-navigation-drawer>
    </div>
    <v-main :class="mainClass">
      <router-view @toggle-drawer="toggleDrawer" />
      <dialog-logout
        :show-dialog="showDialogLogout"
        :negative-button="cancelLogout"
        :positive-button="postLogout"
        :title="'Logout'"
        :message="'Apakah anda yakin akan keluar dari sistem?'"
      />
    </v-main>
  </v-app>
</template>

<script>
import { mapActions, mapGetters, mapState } from 'vuex'
import Dialog from './components/Dialog'
import { menus } from './router/menus'
import { isEmpty } from './plugins/supports'
import DynamicMenuVue from './components/DynamicMenu.vue'
import { APPNAME } from './router/Path'

export default {
  name: 'App',
  components: {
    'dialog-logout': Dialog,
    'dynamic-menu': DynamicMenuVue
  },
  data: () => ({
    drawer: true,
    openNav: true,
    mouseNow: true,
    minivar: true,
    selectedItem: 1,
    tes: { 'no-action': true, 'sub-group': true },
    showDialogLogout: false,
    toolbarTitle: 'Pest Control',
    items: [],
    APPNAME
  }),
  computed: {
    ...mapGetters(['isAuth']),
    ...mapState(['user', 'perm']),
    getUserAvatar () {
      return user?.name?.substring(0, 1)?.toUpperCase() ?? 'O';
    },
    getUserName () {
      return user?.name ?? '';
    },
    getUserRole () {
      return user?.role[0] ?? '';
    },
    mainClass () {
      return (
        'pt-1 ' +
        (this.$vuetify.breakpoint.smAndUp
          ? this.drawer
            ? 'nav-mini'
            : ''
          : '')
      )
    }
  },
  watch: {
    $route (to, from) {
      this.toolbarTitle = to.meta.title
      if (!isEmpty(this.user)) {
        this.authRefresh().then((data) => {
          this.setupMenu(data || [])
          if (this.command === 'logout') {
            this.postLogout()
          }
        })
      }
    }
  },
  created () {
    this.setupMenu(this.perm)
    this.$vuetify.theme.dark = false
    if (localStorage.getItem('drawer')) {
      this.drawer = localStorage.getItem('drawer') === 'true'
      this.minivar = localStorage.getItem('minivar') === 'true'
    }
  },
  methods: {
    ...mapActions(['logout', 'authRefresh']),
    test () {
      return <v-list-item-title>Test</v-list-item-title>
    },
    setupMenu (perm) {
      this.items = []
      for (let i = 0; i < menus.length; i++) {
        const tmpMenu = menus[i].subheader
          ? menus[i]
          : this.genMenus(menus[i], perm)

        if (tmpMenu) {
          this.items.push(tmpMenu)
          if (menus[i].subheader) {
            if (this.items.length > 1) {
              const index = (this.items.length - 1 - 1)
              if (this.items[index].subheader) {
                this.items.splice(index, 1)
              }
            }
          }
        }
      }
    },
    genMenus (menus, perm) {
      // console.log(JSON.stringify(menus))
      const { path, meta } = menus
      const { requirePermission, icon, title, subheader } = meta

      if (!isEmpty(this.user)) {
        if (requirePermission && icon && !isEmpty(perm)) {
          let allow = false
          if (perm.includes(requirePermission)) {
            allow = true
          }

          if (allow) {
            if (icon) {
              const tmp = { title: title, icon: icon }
              tmp.path = path
              if (subheader) {
                let alreadyExist = false
                for (const item of this.items) {
                  if (subheader === item.subheader) {
                    alreadyExist = true
                  }
                }
                if (!alreadyExist) {
                  tmp.subheader = subheader
                }
              }
              if (menus.children) {
                tmp.children = menus.children.map((v) =>
                  this.genMenus(v, perm)
                )
                return tmp
              }
              return tmp
            }
          }
        }
      }
    },
    postLogout () {
      this.logout().then((d) => {
        this.showDialogLogout = false
        if (!this.isAuth) {
          this.$router.push({ name: 'login' })
        }
      })
    },
    cancelLogout () {
      this.showDialogLogout = false
    },
    toggleDrawer () {
      if (this.isAuth) {
        if (this.$vuetify.breakpoint.mdAndUp) {
          this.drawer = !this.drawer
          this.minivar = !this.drawer
          localStorage.setItem('drawer', this.drawer.toString())
          localStorage.setItem('minivar', this.drawer.toString())
        } else {
          this.openNav = !this.openNav
        }
      }
    }
  }
}
</script>
<style>
html {
  overflow: scroll;
  overflow-x: hidden;
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}

::-webkit-scrollbar {
  width: 0px; /* Remove scrollbar space */
  background: transparent; /* Optional: just make scrollbar invisible */
}

/* Optional: show position indicator in red */
::-webkit-scrollbar-thumb {
  background: rgba(217, 217, 217, 0.99);
}

.theme--light.v-application {
  /* background: #f4f5fa !important; */
  background: #fff !important;
}
.default--text {
  color: rgba(94, 86, 105, 0.87) !important;
}
.nav-mini {
  padding-left: 68px !important;
}
.header-mini {
  padding-left: 0 !important;
  left: 68px !important;
}
.theme--light.v-navigation-drawer {
  /* background: #f4f5fa !important; */
  background: #fff !important;
}

.theme--light.v-app-bar.v-toolbar.v-sheet {
  /* background: #f4f5fa !important; */
  background: #fff !important;
}
.vertical-nav-menu-list.v-list-item--active:hover::before,
.vertical-nav-menu-list.v-list-item--active::before {
  /*background: linear-gradient(98deg, #c48eff, #8b56eb 94%);*/
  background: linear-gradient(98deg, #56c0ff, #2b92ff 94%);
  opacity: 1 !important;
}
.vertical-nav-menu-list > .v-list-group__header:hover::before {
  background-color: #eeeff5 !important;
}
.vertical-nav-menu-list
  > .v-list-group__header.theme--light.v-list-item
  > .v-list-item__icon
  > .v-icon,
.vertical-nav-menu-list
  > .v-list-group__header.theme--light.v-list-item
  > .v-list-item-title-custome,
.vertical-nav-menu-list
  > .v-list-group__header.theme--light.v-list-item
  > .v-list-item__content
  > .v-list-item-title-custome {
  color: #756e7f !important;
}
.vertical-nav-menu-list.theme--light.v-list-item {
  color: rgba(94, 86, 105, 0.87) !important;
}
.vertical-nav-menu-list
  > .v-list-group__header.theme--dark.v-list-item
  > .v-list-item__icon
  > .v-icon,
.vertical-nav-menu-list
  > .v-list-group__header.theme--dark.v-list-item
  > .v-list-item-title-custome,
.vertical-nav-menu-list
  > .v-list-group__header.theme--dark.v-list-item
  > .v-list-item__content
  > .v-list-item-title-custome {
  color: #756e7f !important;
}
.vertical-nav-menu-list.theme--dark.v-list-item {
  color: rgb(141, 136, 151) !important;
}
.vertical-nav-menu-list > .v-list-group__header.v-list-item,
.vertical-nav-menu-list.v-list-item {
  height: 44px !important;
  min-height: 44px !important;
  justify-content: flex-start !important;
  padding: 0 18px 0 22px !important;
}
.vertical-nav-menu-list.v-list-item--active
  > .v-list-item__icon
  > .v-list-item-icon-custome {
  color: #fff !important;
}
.vertical-nav-menu-list.v-list-item--active
  > .v-list-item__content
  > .v-list-item-title-custome {
  color: #fff !important;
  z-index: 1;
}
.vertical-nav-menu-list.theme--light.v-list-item--active {
  box-shadow: 0 5px 10px -4px rgba(94, 86, 105, 0.42) !important;
  transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.vertical-nav-menu-list
  > .v-list-group__header.v-list-item
  > .v-list-item__icon,
.vertical-nav-menu-list.v-list-item > .v-list-item__icon {
  margin-right: 12px !important;
  align-self: center !important;
}
.vertical-nav-menu-list
  > .v-list-group__header.v-list-item
  > .v-list-item__content
  > .v-list-item-title-custome,
.vertical-nav-menu-list.v-list-item
  > .v-list-item__content
  > .v-list-item-title-custome {
  line-height: 1.2 !important;
  margin-top: 3px !important;
}
.vertical-nav-menu-list > .v-list-group__header.v-list-item,
.vertical-nav-menu-list.v-list-item {
  margin-top: 0.375rem !important;
}
.vertical-nav-menu-list.v-list-item:first-child {
  margin-top: 0 !important;
}
.vertical-nav-menu-list > .v-list-group__header.v-list-item,
.vertical-nav-menu-list.v-list-item {
  padding: 0 18px 0 22px !important;
}
.nav-mouse-enter {
  box-shadow: 0 5px 6px -3px rgba(94, 86, 105, 0.2),
    0 3px 16px 2px rgba(94, 86, 105, 0.12),
    0 9px 12px 1px rgba(94, 86, 105, 0.14);
}
.v-list-item--active > .v-list-group__header__append-icon > .v-icon {
  transform: rotate(-90deg) !important;
}
.v-list-group__header > .v-list-item__icon.v-list-group__header__append-icon {
  margin-left: 4px !important;
  min-width: auto !important;
}
</style>
