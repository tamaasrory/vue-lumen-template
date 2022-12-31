<template>
  <v-list-item
    v-if="data"
    :to="url()"
    class="vertical-nav-menu-list"
    link
  >
    <v-list-item-icon>
      <v-icon class="v-list-item-icon-custome">
        {{ data.icon }}
      </v-icon>
    </v-list-item-icon>

    <v-list-item-content>
      <v-list-item-title class="v-list-item-title-custome">
        {{ data.title }}
      </v-list-item-title>
    </v-list-item-content>
  </v-list-item>
</template>
<script>
export default {
  name: 'ChildMenu',
  props: {
    data: { type: [Object, Boolean], required: true, default: false },
    path: { type: String, required: false, default: '' }
  },
  methods: {
    url () {
      return this.path ? this.path + '/' + this.data.path : this.data.path
    }
  }
}
</script>
