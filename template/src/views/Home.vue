<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div class="home">
    <v-app-bar flat>
      <v-icon
        color="#00a3ff"
        class="ml-1 mr-5 d-md-none"
        @click="$emit('toggle-drawer')"
        v-text="'mdi-menu'"
      />
      <v-toolbar-title class="ml-md-2">
        Dashboard
      </v-toolbar-title>
      <v-spacer />
    </v-app-bar>
    <v-container
      fluid
      style="padding: 0 1.5rem 0 1.5rem"
    >
      <v-card>
        <v-card-title>
          Title
        </v-card-title>
        <v-divider />
        <v-card-text class="display-1">
          Ahlan wa sahlan...
        </v-card-text>
      </v-card>
    </v-container>
  </div>
</template>

<script>
export default {
  name: 'Home',
  components: {
  },
  data: function () {
    return {
    }
  },
  computed: {
  },
  created () {
  },
  methods: {
  }
}
</script>
<style scoped>
.lead {
  font-size: 12pt !important;
  color: #6c6b6b;
}
</style>
