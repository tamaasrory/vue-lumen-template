<!--
  - author : tama asrory
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
        Tambah User
      </v-toolbar-title>
    </v-app-bar>
    <v-container>
      <v-row class="py-0 py-md-3">
        <v-col
          cols="12"
          md="10"
          class="mx-auto"
        >
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
                label="Email"
                outlined
                :rules="[rules.required,rules.email]"
              />
              <v-text-field
                v-model="user.password"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showPassword ? 'text' : 'password'"
                label="Password"
                outlined
                :rules="[rules.required]"
                @click:append="showPassword = !showPassword"
              />
              <v-text-field
                v-model="user.confirmPassword"
                :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showConfirmPassword ? 'text' : 'password'"
                label="Confirm Password"
                outlined
                :rules="[rules.required,rules.confirmPassword]"
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
        </v-col>
      </v-row>
    </v-container>
    <dialog-confirm
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
    'dialog-confirm': Dialog
  },
  data () {
    return {
      loadingData: true,
      showPassword: false,
      showConfirmPassword: false,

      roles: [],
      user: {
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
        email: 'required|email',
        name: 'required',
        password: 'required',
        confirmPassword: 'required|confirmPassword',
        roles: 'required'
      },
      errors: {},
      rules: {
        required: v => {
          v = isEmpty(v)
          return !v || 'Tidak Boleh Kosong'
        },
        email: v => {
          v = /.+@.+\..+/.test(v)
          return v || 'E-mail tidak valid'
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
      dcNegativeBtn: () => {
        this.showDC = false
      },
      dcPositiveBtn: () => this.postSave()
    }
  },
  computed: {
    dataValidation () {
      return inputValidator(this.schema, this.rules, this.user)
    }
  },
  created () {
    this.getUserCreate({ id: this.id })
      .then(data => {
        this.roles = isEmpty(data, (r, v) => (r ? [] : v))
        this.loadingData = false
      })
      .catch(() => {
        this.roles = []
      })
  },
  methods: {
    ...mapActions(['getUserCreate', 'addUser']),
    backButton () {
      this.$router.push({ name: 'user' })
    },
    postSave () {
      this.dcProgress = true
      this.dcdisabledNegativeBtn = true
      this.dcdisabledPositiveBtn = true
      this.dcMessages = 'Sedang Menyimpan User...'

      this.addUser(this.user).then((res) => {
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
