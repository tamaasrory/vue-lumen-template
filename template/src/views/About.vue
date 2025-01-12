<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div class="about">
    <v-container>
      <v-layout
        class="mt-7"
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
          <div class="subheading font-weight-bold mt-2 text-h6">
            Vue Lumen Template by https://tamaasrory.com
          </div>
          <div>Version v1.0</div>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>
