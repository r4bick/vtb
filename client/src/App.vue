<script setup lang="ts">
import { Component, computed } from 'vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'

const layout = computed(() => {
  return DefaultLayout as Component
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
