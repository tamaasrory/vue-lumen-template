<!--
  - Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
  - website : https://tamaasrory.com
  - email : tamaasrory@gmail.com
  -->

<template>
  <div class="not-found">
    <v-container>
      <v-layout
        text-center
        wrap
      >
        <v-flex xs12>
          <v-img
            :src="require('../assets/icon.svg')"
            class="my-3"
            contain
            height="200"
          />
        </v-flex>

        <v-flex mb-4>
          <h1 class="display-2 font-weight-bold mb-3">
            Page Not Found
          </h1>
          <p class="subheading font-weight-regular">
            Back to <v-btn
              light
              to="/"
            >
              home
            </v-btn> or try again
          </p>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>

<style scoped>

</style>
