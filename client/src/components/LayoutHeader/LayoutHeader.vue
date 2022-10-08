<script setup lang="ts">
import { defineProps, PropType } from 'vue'
import { IHeaderLink } from '@/types/interfaces'
import { useEthereum } from '@/composables/useEthereum'

const props = defineProps({
  links: { type: Array as PropType<IHeaderLink[]> },
})

const { coinBalance, createWallet, connected } = useEthereum()
</script>

<template>
  <div class="layout-header">
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

    <div class="info" v-if="connected">
      <span class="info__label">Баланс</span>
      <span class="info__value">{{ coinBalance || '0.00' }}</span>
    </div>
    <div class="info" v-else>
      <EButton @click="createWallet">Создать кошелек</EButton>
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

  .links-list {
    display: flex;
    justify-content: flex-end;
    gap: 86px;
    flex: 1 1 85%;
    //margin-left: auto;

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
    justify-content: flex-end;
    margin-left: auto;

    &__label {
      @include h6();
    }

    &__value {
      @include h3();
      color: $default-accent-vtb;
    }
  }
}
</style>
