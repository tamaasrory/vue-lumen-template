<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div>
    <v-app-bar
      fixed
      dark
      color="#00a3ff"
    >
      <v-btn
        icon
        dark
        @click="backButton"
      >
        <v-icon color="#00a3ff">
          mdi-arrow-left
        </v-icon>
      </v-btn>
      <v-toolbar-title style="line-height: 1.3">
        Detail Area
        <div
          v-if="!loadingData"
          style="font-size: 11pt"
        >
          {{ area.id }}
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
      <v-row class="py-0 mx-1">
        <v-col
          cols="12"
          md="4"
          class="mx-md-auto elevation-2"
          style="border-radius: 10px"
        >
          <div class="d-flex justify-center mt-2">
            <v-icon
              size="150"
              color="info"
              class="float-left"
            >
              mdi-flask-round-bottom
            </v-icon>
          </div>
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
                  class="v-label v-label--active theme--light"
                  style="font-size: 9pt !important;"
                >
                  Nama Area
                </label>
                <div v-text="area.nama" />
              </v-col>
              <v-col
                cols="12"
                md="12"
              >
                <label
                  class="v-label v-label--active theme--light"
                  style="font-size: 9pt !important;"
                >
                  Gender
                </label>
                <div v-text="area.gender" />
              </v-col>
              <v-col
                cols="12"
                md="12"
              >
                <label
                  class="v-label v-label--active theme--light"
                  style="font-size: 9pt !important;"
                >
                  Aroma
                </label>
                <div v-text="area.aroma" />
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
    id: { type: String, required: true }
  },
  data () {
    return {
      loadingData: true,
      area: {}
    }
  },
  created () {
    this.getAreaById({ id: this.id })
      .then(data => {
        this.area = data || {}
        this.loadingData = false
      })
      .catch((error) => {
        this.area = {}
        console.log('Error : ' + error)
      })
  },
  methods: {
    ...mapActions(['getAreaById']),
    backButton () {
      this.$router.push({ name: 'area' })
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
