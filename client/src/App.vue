<script setup lang="ts">
import { computed } from 'vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const layout = computed(() => {
  if (route.meta?.layout === 'admin') {
    return AdminLayout
  }
  return DefaultLayout
})
</script>

<template>
  <component :is="layout">
    <template v-slot:content>
      <router-view />
    </template>
  </component>
</template>

<style lang="scss"></style>
