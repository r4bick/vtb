<script setup lang="ts">
import { defineProps } from 'vue'

interface BadgeToggleProps {
  active: boolean
}

defineProps<BadgeToggleProps>()
</script>

<template>
  <div class="badge" :class="{ 'badge--active': active }">
    <slot></slot>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';

.badge {
  cursor: pointer;
  display: flex;
  align-items: center;
  text-align: center;
  background: $gray-300;
  box-shadow: $shadow-sm;
  border-radius: $all-sides-large;
  font-weight: $h6-font-style;
  font-size: $h6-font-size;
  line-height: 17px;
  color: $gray-600;
  padding: 8px 12px;
  transition: background-color, color, 0.06s ease-in;
  user-select: none;

  &--active {
    background-color: $pressed-secondary-vtb;
    color: $base-white;
  }
}
</style>
