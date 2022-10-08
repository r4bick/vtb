<script setup lang="ts"></script>

<template>
  <div class="layout-container">
    <div class="header">
      <p class="header__title">Система мотивации сотрудников компании ВТБ</p>
    </div>
    <div class="layout-container__image">
      <img :src="require('@/assets/img/planet.png')" alt="planet" />
    </div>
    <div class="content">
      <slot name="content"></slot>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.layout-container {
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  min-height: calc(100vh - 65px);
  max-height: 100vh;

  background: url('@/assets/img/auth-background.png');
  background-repeat: no-repeat;
  background-size: cover;

  &__image {
    display: flex;
    justify-content: flex-end;
    width: 100%;
    margin-top: 19px;
  }
  .header {
    padding: 43px 0 0 50px;

    &__title {
      @include p2();
      color: $base-white;
    }
  }

  .content {
    background-color: transparent;
    margin-left: 224px;
    margin-bottom: 224px;
    transform: translateY(-16px);
  }
}
</style>
