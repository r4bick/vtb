<script setup lang="ts">
import { defineEmits, PropType, defineProps } from 'vue'
import { IDepartment } from '@/types/department/interfaces'

const emit = defineEmits(['edit', 'delete', 'updateBalance'])
const props = defineProps({
  item: { type: Object as PropType<IDepartment> },
})
</script>

<template>
  <div class="department">
    <div class="department__header">Отдел {{ item.name }}</div>
    <div class="department__body">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad,
      exercitationem.
    </div>
    <div class="department__actions">
      <EButton @click="emit('edit')">Редактировать</EButton>

      <EButton @click="emit('delete')">Удалить</EButton>
      <EButton @click="emit('updateBalance')">Пополнить кошелек отдела</EButton>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.department {
  border-radius: 16px;
  position: relative;
  @include card();
  display: flex;
  flex-direction: column;
  min-width: 320px;
  min-height: 155px;
  padding: 16px;
  background: $base-white;

  &__header {
    margin-bottom: 20px;
  }
  &__body {
    margin-bottom: 20px;
  }
  &__actions {
    display: flex;
    gap: 15px;
  }
}
</style>
