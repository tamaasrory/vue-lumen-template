<!--
  - Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
  - website : https://tamaasrory.com
  - email : tamaasrory@gmail.com
  -->

<template>
  <v-container
    fluid
    fill-height
    class="p-0"
  >
    <v-layout
      align-center
      justify-center
    >
      <v-flex
        xs12
        sm6
        md4
        class="px-5"
      >
        <div
          style="font-size: 22pt;"
          class="pt-5"
        >
          Account Login
        </div>
        <div
          class="lead pb-5"
          style="color: #9e9fb4 !important;"
        >
          Sign in to your account using email and password provided during registration.
        </div>
        <v-form>
          <v-text-field
            v-model="data.email"
            label="Email"
            name="email"
            prepend-inner-icon="mdi-account"
            outlined
            rounded
            :disabled="loading"
            :rules="[rules.required,rules.emailMatch]"
          />
          <v-text-field
            id="password"
            v-model="data.password"
            label="Password"
            name="password"
            outlined
            prepend-inner-icon="mdi-lock"
            rounded
            :disabled="loading"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required]"
            :type="showPassword ? 'text' : 'password'"
            @click:append="showPassword = !showPassword"
          />
        </v-form>
        <v-btn
          :loading="loading"
          :disabled="isComplate"
          color="#2c7be5"
          class="pl-5 pr-5"
          rounded
          x-large
          :dark="!isComplate"
          block
          @click="postLogin"
        >
          Login
        </v-btn>
        <v-snackbar
          v-model="snackbar"
          vertical
        >
          {{ errors.message }}
          <v-btn
            color="pink"
            text
            @click="snackbar = false"
          >
            close
          </v-btn>
        </v-snackbar>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { mapActions, mapGetters, mapMutations, mapState } from 'vuex'
import { isEmpty } from '@/plugins/supports'

export default {
  data () {
    return {
      data: {
        username: '',
        password: '',
        remember_me: false
      },
      showPassword: false,
      rules: {
        required: value => !!value || 'Tidak Boleh Kosong',
        emailMatch: v => /.+@.+\..+/.test(v) || 'E-mail tidak valid'
      },
      loader: null,
      loading: false,
      snackbar: false
    }
  },
  computed: {
    ...mapGetters(['isAuth']),
    ...mapState(['errors']),
    isComplate () {
      return isEmpty(this.data.username) && isEmpty(this.data.password) && !this.loading
    }
  },
  watch: {
    loader () {
      this.loading = !this.loader
      this.loader = null
    }
  },
  created () {
    if (this.isAuth) {
      this.$router.push({ name: 'home' })
    }
  },
  methods: {
    ...mapMutations(['CLEAR_ERRORS']),
    ...mapActions(['login']),
    postLogin () {
      this.loader = 'loading'
      this.CLEAR_ERRORS()
      this.login(this.data).then((data) => {
        if (this.isAuth) {
          // MAKA AKAN DI-DIRECT KE ROUTE DENGAN NAME home
          this.$router.push({ name: 'home' })
        } else {
          this.snackbar = true
          this.loading = false
        }
      })
    }
  }
}
</script>
<style>
  .custom-loader {
    animation: loader 1s infinite;
    display: flex;
  }
  @-moz-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-webkit-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-o-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
</style>
