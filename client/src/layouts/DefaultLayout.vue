<script setup lang="ts">
import { LayoutHeader } from '@/components'
</script>

<template>
  <div class="layout-container">
    <LayoutHeader classs="header" />
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
  padding-top: 49px;

  .header {
    top: 0;
    width: 100%;
    position: fixed;
    z-index: 10;
  }

  .content {
    width: 100%;
    min-height: calc(100vh - 49px); // высота хэдера;
  }
}
</style>
