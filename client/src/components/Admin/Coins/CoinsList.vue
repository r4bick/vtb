<script setup lang="ts">
import { defineEmits, PropType, defineProps, computed } from 'vue'

const emit = defineEmits(['edit', 'delete', 'updateBalance'])
const props = defineProps({
  // total: { type: Number },
  handAmount: { type: Number, default: 0 },
  bankAmount: { type: Number, default: 0 },
})

const total = computed(() => {
  return props.handAmount + props.bankAmount
})
</script>

<template>
  <div class="coins__list">
    <div class="coins__item">
      Всего в обороте: <span class="bold">{{ total }}</span>
    </div>
    <div class="coins__item">
      На руках: <span class="bold">{{ handAmount }}</span>
    </div>
    <div class="coins__item">
      В банке: <span class="bold">{{ bankAmount }}</span>
    </div>
    <div class="coins__item">
      <slot />
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.coins {
  &__list {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  &__item {
  }

  .bold {
    font-weight: bold;
  }
}
</style>
