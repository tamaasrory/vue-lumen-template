<template>
  <v-row justify="center">
    <v-dialog
      v-model="showDialog"
      :persistent="persistentDialog"
      max-width="400"
    >
      <v-card>
        <v-card-title class="headline">
          {{ title }}
        </v-card-title>
        <v-card-text>
          <div
            style="font-size: 17px"
            class="mb-1"
            v-html="message"
          />
          <v-progress-linear
            v-show="progress"
            color="primary"
            indeterminate
            rounded
            height="6"
          />
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn
            v-if="negativeButton"
            color="green darken-1"
            text
            :disabled="disabledNegativeBtn"
            @click="negativeButton"
          >
            {{ negativeBtnLabel }}
          </v-btn>
          <v-btn
            v-if="positiveButton"
            color="green darken-1"
            text
            :disabled="disabledPositiveBtn"
            @click="positiveButton"
          >
            {{ positiveBtnLabel }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  name: 'Dialog',
  props: {
    showDialog: {
      type: Boolean,
      default: false,
      required: true
    },
    persistentDialog: {
      type: Boolean,
      default: true,
      required: false
    },
    positiveBtnLabel: {
      type: String,
      default: 'Ya',
      required: false
    },
    negativeBtnLabel: {
      type: String,
      default: 'Tidak',
      required: false
    },
    positiveButton: {
      type: [Function, Boolean],
      default: () => {},
      required: false
    },
    negativeButton: {
      type: [Function, Boolean],
      default: () => {},
      required: false
    },
    disabledNegativeBtn: {
      type: Boolean,
      default: false,
      required: false
    },
    disabledPositiveBtn: {
      type: Boolean,
      default: false,
      required: false
    },
    title: {
      type: String,
      default: null,
      required: true
    },
    message: {
      type: String,
      default: '',
      required: true
    },
    progress: {
      type: Boolean,
      default: false,
      required: false
    }
  },
  data: () => ({})
}
</script>

<style scoped>

</style>
