<template>
  <v-subheader
    v-show="data"
    class="v-sub-custome"
  >
    <v-icon
      v-show="mini"
      large
      color="primary"
    >
      mdi-minus
    </v-icon>
    <span
      v-show="!mini"
      style="margin-left: 7px;font-weight:bold"
    >
      {{ data.subheader }}
    </span>
  </v-subheader>
</template>
<script>
export default {
  name: 'SectionMenu',
  props: {
    data: { type: [Object, Boolean], required: true, default: false },
    mini: { type: Boolean, required: true, default: false }
  }
}
</script>
<style scoped>
.v-sub-custome {
  white-space: nowrap !important;
}
</style>
