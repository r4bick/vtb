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
  flex-direction: column;
  width: 100%;
  min-height: 100vh;
  max-height: 100vh;

  background: url('@/assets/img/auth-background.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;

  &__image {
    position: absolute;
    display: flex;
    justify-content: flex-end;
    width: 100%;
    top: 10%;
    right: 15%;
  }

  .header {
    padding: 43px 0 50px 50px;

    &__title {
      @include p2();
      color: $base-white;
    }
  }

  .content {
    display: flex;
    align-items: flex-end;
    background-color: transparent;
    flex: 1;
    margin-top: auto;
    margin-left: 224px;
    margin-bottom: 224px;
  }
}
</style>
