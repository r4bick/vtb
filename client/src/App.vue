<script setup lang="ts">
import { computed, onMounted } from 'vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import AdminLayout from '@/layouts/AdminLayout.vue'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { useRoute } from 'vue-router'
import { useUserStore } from '@/store/userStore'

const userStore = useUserStore()
const route = useRoute()

const layout = computed(() => {
  if (route.meta?.layout === 'admin') {
    return AdminLayout
  }
  switch (route.meta.layout) {
    case 'admin':
      return AdminLayout
    case 'auth':
      return AuthLayout
    default:
      return DefaultLayout
  }
})

onMounted(() => {
  userStore.getCurrentUser().then((user) => {
    userStore.currentUser = user
  })
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
