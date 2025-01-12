<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->
<template>
  <div>
    <component
      :is="resolveComponent(menu)"
      v-for="(menu, i) in menus"
      :key="i"
      :data="menu"
      :path="path"
      :mini="isMini"
    />
  </div>
</template>
<script>
import ChildMenuVue from './ChildMenu.vue'
import ParentMenuVue from './ParentMenu.vue'
import SectionMenuVue from './SectionMenu.vue'
export default {
  name: 'DynamicMenu',
  components: {
    'section-menu': SectionMenuVue,
    'child-menu': ChildMenuVue,
    'parent-menu': ParentMenuVue
  },
  props: {
    menus: { type: Array, required: true, default: () => {} },
    path: { type: String, required: false, default: '' },
    isMini: { type: Boolean, required: false, default: true }
  },
  methods: {
    resolveComponent (item) {
      return item?.subheader ? 'section-menu' : (item?.children ? 'parent-menu' : 'child-menu')
    }
  }
}
</script>
