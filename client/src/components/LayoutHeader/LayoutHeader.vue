<script setup lang="ts">
import { defineProps, PropType } from 'vue'
import { IHeaderLink } from '@/types/interfaces'
import { useEthereum } from '@/composables/useEthereum'
import { useUserStore } from '@/store/userStore'
import { MAIN_CHAIN } from '@/types/enums'
import { useRouter } from 'vue-router'

const props = defineProps({
  links: { type: Array as PropType<IHeaderLink[]> },
})

const { coinBalance } = useEthereum()
const userStore = useUserStore()
const router = useRouter()

const logout = () => {
  userStore.logout()
  router.push('/sign-in')
}
</script>

<template>
  <div class="layout-header">
    <div class="info">
      <span class="info__label">Баланс</span>
      <span class="info__value">{{ coinBalance.toFixed(2) || '0.00' }}</span>
    </div>

    <div class="links-list">
      <router-link
        class="links-list__item"
        active-class="links-list__item--active"
        :to="link.to"
        v-for="link in links"
        :key="link.label"
      >
        {{ link.label }}
      </router-link>
    </div>

    <div class="exit-button">
      <button class="exit-button__button" @click="logout">Выйти</button>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.layout-header {
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  border-bottom: 1px solid $gray-300;
  padding: 0 50px;

  .links-list {
    display: flex;
    justify-content: center;
    gap: 86px;
    flex: 1 1 50%;

    &__item {
      @include p6();
      color: $default-accent-vtb;
      text-decoration: none;
      padding-top: 19px;
      padding-bottom: 15px;
      border-bottom: 4px solid transparent;

      &--active {
        border-color: $default-accent-vtb;
      }
    }
  }

  .info {
    flex: 1 1 50%;
    display: flex;
    align-items: center;
    gap: 12px;

    &__label {
      @include h6();
    }

    &__value {
      @include h3();
      color: $default-accent-vtb;
      margin-right: 50px;
    }
  }

  .exit-button {
    display: flex;
    flex: 1 1 50%;
    justify-content: flex-end;

    &__button {
      @include p6();
      cursor: pointer;
      background: none;
      border: none;
      color: $gray-500;
      padding: 15px;
    }
  }
}
</style>
