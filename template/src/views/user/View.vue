<!--
  - Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
  - website : https://tamaasrory.com
  - email : tamaasrory@gmail.com
  -->

<template>
  <div>
    <v-app-bar flat>
      <v-btn
        icon
        light
        @click="backButton"
      >
        <v-icon color="#00a3ff">
          mdi-arrow-left
        </v-icon>
      </v-btn>
      <v-toolbar-title style="line-height: 1.3">
        Detail User
        <div
          v-if="!loadingData"
          style="font-size: 11pt"
        >
          {{ user.id }}
        </div>
        <v-skeleton-loader
          v-else
          ref="skeleton"
          type="text"
          max-width="100%"
        />
      </v-toolbar-title>
    </v-app-bar>
    <v-container>
      <v-row class="py-0 mx-1 py-md-3">
        <v-col
          cols="12"
          md="4"
          class="mx-md-auto elevation-2"
          style="border-radius: 10px"
        >
          <v-col
            cols="12"
            md="6"
            class="d-flex"
          >
            <v-row>
              <v-col
                cols="12"
                md="12"
              >
                <label
                  class="v-label v-label--active"
                  style="font-size: 9pt !important;"
                >
                  Nama User
                </label>
                <div v-text="user.name" />
              </v-col>
              <v-col
                cols="12"
                md="12"
              >
                <label
                  class="v-label v-label--active"
                  style="font-size: 9pt !important;"
                >
                  Email
                </label>
                <div v-text="user.email || `-`" />
              </v-col>
              <v-col
                cols="12"
                md="12"
              >
                <label
                  class="v-label v-label--active"
                  style="font-size: 9pt !important;"
                >
                  Hak Akses
                </label>
                <div>
                  <span v-if="!user.role.length">-</span>
                  <span
                    v-for="(role,i) in user.role"
                    v-else
                    :key="i"
                    class="d-inline-block"
                    style="margin-right: 3px;margin-top: 3px"
                  >
                    <v-chip
                      color="green"
                      outlined
                      v-text="role"
                    />
                  </span>
                </div>
              </v-col>
              <v-col
                cols="12"
                md="12"
              >
                <label
                  class="v-label v-label--active"
                  style="font-size: 9pt !important;"
                >
                  No. HP
                </label>
                <div>
                  <span v-if="!user.detail">-</span>
                  <span v-else>{{ user.detail.no_hp || '-' }} </span>
                </div>
              </v-col>
              <v-col
                cols="12"
                md="12"
              >
                <label
                  class="v-label v-label--active"
                  style="font-size: 9pt !important;"
                >
                  Last Access
                </label>
                <div>
                  <span v-if="!user.detail">-</span>
                  <span v-else>{{ user.detail.lastAccess }} </span>
                </div>
              </v-col>
            </v-row>
          </v-col>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  props: {
    id: { type: [String, Number], required: true }
  },
  data () {
    return {
      loadingData: true,
      user: {
        name: null,
        email: null,
        role: [],
        detail: {
          lastAccess: null,
          no_hp: null
        }
      }
    }
  },
  created () {
    this.getUserById({ id: this.id })
      .then(data => {
        this.user = data || {}
        this.loadingData = false
      })
      .catch((error) => {
        this.user = {}
        console.log('Error : ' + error)
      })
  },
  methods: {
    ...mapActions(['getUserById']),
    backButton () {
      this.$router.push({ name: 'user' })
    }
  }
}
</script>

<style scoped>
  .v-label {
    font-size: 19px !important;
  }

  .v-text-field > .v-input__control > .v-input__slot::after {
    content: none !important;
  }
</style>
