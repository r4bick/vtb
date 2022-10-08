<script setup lang="ts">
import { LayoutHeader } from '@/components'

const links = [
  {
    to: '/admin',
    label: 'Профиль',
  },
  {
    to: '/admin-users',
    label: 'Пользователи',
  },
  {
    to: '/admin-tasks',
    label: 'Задачи',
  },
  {
    to: '/departments',
    label: 'Орг. структура',
  },
  {
    to: '/statistics',
    label: 'Статистика',
  },
  {
    to: '/coins',
    label: 'Казна',
  },
  {
    to: '/shop',
    label: 'Магазин мерча',
  },
]
</script>

<template>
  <div class="layout-container">
    <LayoutHeader classs="header" :links="links" />
    <div class="content">
      <slot name="content"></slot>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';

.layout-container {
  width: 100%;
  min-height: 100vh;
  height: 100%;

  .header {
    top: 0;
    width: 100%;
    position: fixed;
    z-index: 10;
  }

  .content {
    //width: 100%;
    min-height: calc(100vh - 56px); // высота хэдера;
    background-color: $gray-100-vtb;
    padding: 40px 50px 170px 50px;
  }

  :deep(.layout-header) {
    .links-list {
      justify-content: center;
      margin-right: -286px; // 286 -   width of info__value
    }

    .info {
      flex: 1 1;
    }
  }
}
</style>
