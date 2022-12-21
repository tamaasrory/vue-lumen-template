<!--
  - Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
  - website : https://tamaasrory.com
  - email : tamaasrory@gmail.com
  -->

<template>
  <div>
    <v-app-bar flat>
      <v-icon
        color="#00a3ff"
        class="mr-5 d-md-none"
        @click="$emit('toggle-drawer')"
        v-text="'mdi-menu'"
      />
      <v-btn
        icon
        light
        class="d-none d-md-block"
        @click="backButton"
      >
        <v-icon color="#00a3ff">
          mdi-arrow-left
        </v-icon>
      </v-btn>
      <v-toolbar-title style="line-height: 1.3">
        Edit User
        <div
          v-if="!loadingData"
          style="font-size: 10pt"
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
    <v-container
      fluid
      style="padding: 1rem 1.5rem 0 1.5rem;"
    >
      <v-card style="box-shadow: 0 2px 10px 0 rgba(94,86,105,.1);">
        <v-card-text>
          <v-row>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="user.name"
                label="Nama"
                outlined
                :rules="[rules.required]"
              />
              <v-text-field
                v-model="user.email"
                label="email"
                outlined
                :rules="[rules.email]"
              />
              <v-text-field
                v-model="user.password"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showPassword ? 'text' : 'password'"
                label="Password"
                outlined
                @click:append="showPassword = !showPassword"
              />
              <v-text-field
                v-model="user.confirmPassword"
                :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showConfirmPassword ? 'text' : 'password'"
                label="Confirm Password"
                outlined
                :rules="[rules.confirmPassword]"
                @click:append="showConfirmPassword = !showConfirmPassword"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="user.detail.no_hp"
                label="No. HP"
                outlined
              />
              <v-autocomplete
                v-model="user.roles"
                :items="roles"
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
                class="d-flex align-self-center"
                :dark="!dataValidation"
                :disabled="dataValidation"
                @click="showDC = true"
              >
                <v-icon color="white">
                  mdi-check
                </v-icon>
                SIMPAN
              </v-btn>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-container>
    <update-dialog-confirm
      :show-dialog="showDC"
      :negative-button="dcNegativeBtn"
      :positive-button="dcPositiveBtn"
      :disabled-negative-btn="dcdisabledNegativeBtn"
      :disabled-positive-btn="dcdisabledPositiveBtn"
      :title="'Perbarui'"
      :message="dcMessages"
      :progress="dcProgress"
    />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import Dialog from '@/components/Dialog'
import { inputValidator, isEmpty } from '@/plugins/supports'

export default {
  components: {
    'update-dialog-confirm': Dialog
  },
  props: {
    id: { type: [String, Number], required: true }
  },
  data () {
    return {
      loadingData: true,
      showPassword: false,
      showConfirmPassword: false,
      roles: [],
      user: {
        id: this.id,
        detail: {
          no_hp: null
        },
        email: null,
        name: null,
        password: null,
        confirmPassword: null,
        roles: []
      },
      schema: {
        email: 'email',
        name: 'required',
        roles: 'required'
      },
      rules: {
        required: v => {
          v = isEmpty(v)
          return !v || 'Tidak Boleh Kosong'
        },
        email: v => {
          if (v) {
            v = /.+@.+\..+/.test(v)
            return v || 'E-mail tidak valid'
          }
          return true
        },
        confirmPassword: (v) => {
          v = (this.user.password === this.user.confirmPassword)
          return v || 'Password tidak cocok'
        }
      },
      showDC: false,
      dcMessages: 'Simpan Perubahan Sekarang?',
      dcProgress: false,
      dcdisabledNegativeBtn: false,
      dcdisabledPositiveBtn: false,
      dcNegativeBtn: () => { this.showDC = false },
      dcPositiveBtn: () => this.postSave()
    }
  },
  computed: {
    dataValidation () {
      return inputValidator(this.schema, this.rules, this.user)
    }
  },
  created () {
    this.getUserEdit({ id: this.id })
      .then(data => {
        this.user.id = this.id
        this.user.detail = isEmpty(data.user.detail, (r, v) => (r ? {} : v))
        this.user.email = data.user.email ?? ''
        this.user.name = data.user.name ?? ''
        this.user.roles = data.hasRoles ?? []
        this.roles = data.roles ?? []

        this.loadingData = false
      })
      .catch(() => {
        this.user = {
          detail: {
            no_hp: null
          },
          email: null,
          name: null,
          password: null,
          roles: []
        }
        this.roles = []
      })
  },
  methods: {
    ...mapActions(['getUserEdit', 'updateUser']),
    backButton () {
      this.$router.push({ name: 'user' })
    },
    postSave () {
      this.dcProgress = true
      this.dcdisabledNegativeBtn = true
      this.dcdisabledPositiveBtn = true
      this.dcMessages = 'Sedang Menyimpan User...'

      this.updateUser(this.user).then((res) => {
        this.dcMessages = 'Berhasil Memperbarui User'
        this.dcProgress = false
        setTimeout(() => {
          this.showDC = false
          this.dcdisabledNegativeBtn = false
          this.dcdisabledPositiveBtn = false
          this.$router.push({ name: 'user' })
          this.dcMessages = 'Simpan Perubahan Sekarang?'
        }, 1500)
      })
    }
  }
}
</script>

<style scoped>

</style>
