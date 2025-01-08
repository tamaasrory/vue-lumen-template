<template>
  <v-list-group
    class="vertical-nav-menu-list"
    no-action
  >
    <template #prependIcon>
      <v-icon>
        {{ data.icon }}
      </v-icon>
    </template>
    <template #activator>
      <v-list-item-title
        class="v-list-item-title-custome"
        v-text="data.title"
      />

      <v-list-item-action
        v-if="data.badge"
        class="flex-shrink-0"
      >
        <v-badge
          :color="data.badgeColor"
          inline
          :content="data.badge"
        />
      </v-list-item-action>
    </template>
    <template #appendIcon>
      <v-icon> mdi-chevron-right </v-icon>
    </template>
    <DynamicMenuVue
      :menus="data.children"
      :path="data.path"
    />
  </v-list-group>
</template>

<script>
export default {
  name: 'ParentMenu',
  components: {
    DynamicMenuVue: () => import('./DynamicMenu.vue')
  },
  props: {
    data: { type: [Object, Array], required: true, default: () => {} },
    path: { type: String, required: false, default: '' }
  }
}
</script>
