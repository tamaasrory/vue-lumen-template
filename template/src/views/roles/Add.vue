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
      <v-toolbar-title class="ml-md-2">
        Roles Baru
      </v-toolbar-title>
    </v-app-bar>
    <v-container>
      <v-row class="py-0 py-md-3">
        <v-col
          cols="12"
          md="6"
          class="mx-auto"
        >
          <v-row>
            <v-col
              cols="12"
              md="12"
            >
              <v-text-field
                v-model="roles.name"
                label="Hak Akses"
                outlined
                :rules="[rules.required]"
              />
              <v-autocomplete
                v-model="roles.permissions"
                :items="permissions"
                outlined
                chips
                deletable-chips
                label="Izin"
                multiple
                :rules="[rules.required]"
              />
              <v-btn
                color="green"
                large
                :dark="dataValidation"
                :disabled="!dataValidation"
                @click="showDC = true"
              >
                <v-icon color="white">
                  mdi-check
                </v-icon>
                SIMPAN
              </v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
    <dialog-confirm
      :show-dialog="showDC"
      :negative-button="dcNegativeBtn"
      :positive-button="dcPositiveBtn"
      :disabled-negative-btn="dcdisabledNegativeBtn"
      :disabled-positive-btn="dcdisabledPositiveBtn"
      :progress="dcProgress"
      :title="'Simpan'"
      :message="dcMessages"
    />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import Dialog from '@/components/Dialog'

export default {
  components: {
    'dialog-confirm': Dialog
  },
  data () {
    return {
      loadingData: true,
      permissions: [],
      roles: {
        name: null,
        permissions: []
      },
      rules: {
        required: value => !!value || 'Tidak Boleh Kosong'
      },
      showDC: false,
      dcMessages: 'Simpan Roles Baru Sekarang?',
      dcProgress: false,
      dcdisabledNegativeBtn: false,
      dcdisabledPositiveBtn: false,
      dcNegativeBtn: () => { this.showDC = false },
      dcPositiveBtn: () => this.postAdd()
    }
  },
  computed: {
    dataValidation () {
      return !!(this.roles.name && this.roles.permissions.length)
    }
  },
  mounted () {
    this.getPermissions()
      .then(data => {
        this.permissions = data
      }).catch(() => {
        this.permissions = []
      })
    console.log('mounted')
  },
  methods: {
    ...mapActions(['addRoles', 'getPermissions']),
    backButton () {
      this.$router.push({ name: 'roles' })
    },
    postAdd () {
      this.dcProgress = true
      this.dcdisabledNegativeBtn = true
      this.dcdisabledPositiveBtn = true
      this.dcMessages = 'Tunggu Sebentar, Sedang Menyimpan Roles Baru...'
      this.addRoles(this.roles).then((res) => {
        this.dcProgress = false
        this.dcMessages = 'Berhasil Menyimpan Roles Baru'
        setTimeout(() => {
          this.showDC = false
          this.$router.push({ name: 'roles' })
          this.dcMessages = 'Simpan Roles Baru Sekarang?'
        }, 1500)
      })
    }
  }
}
</script>

<style scoped>

</style>
