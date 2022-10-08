<script setup lang="ts">
import { defineProps } from 'vue'

interface CloseSVGProps {
  fill?: string
}

defineProps<CloseSVGProps>()
</script>

<template>
  <svg
    width="24"
    height="24"
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      fill-rule="evenodd"
      clip-rule="evenodd"
      d="M1.93934 1.93934C2.52513 1.35355 3.47487 1.35355 4.06066 1.93934L12 9.87868L19.9393 1.93934C20.5251 1.35355 21.4749 1.35355 22.0607 1.93934C22.6464 2.52513 22.6464 3.47487 22.0607 4.06066L14.1213 12L22.0607 19.9393C22.6464 20.5251 22.6464 21.4749 22.0607 22.0607C21.4749 22.6464 20.5251 22.6464 19.9393 22.0607L12 14.1213L4.06066 22.0607C3.47487 22.6464 2.52513 22.6464 1.93934 22.0607C1.35355 21.4749 1.35355 20.5251 1.93934 19.9393L9.87868 12L1.93934 4.06066C1.35355 3.47487 1.35355 2.52513 1.93934 1.93934Z"
      :fill="fill || 'white'"
    />
  </svg>
</template>

<style scoped lang="scss"></style>
