<script setup lang="ts">
import CoinsList from '@/components/Admin/Coins/CoinsList.vue'
import { ref } from 'vue'
import ETabs from '@/components/Egal/ETabs.vue'

// tabs
const tabs = [
  { key: 1, name: 'NFT' },
  { key: 2, name: 'Монеты' },
]
const activeTab = ref(1)
const switchTab = (key: number) => {
  activeTab.value = key
}

const emitNewNFT = () => {
  console.log('emitNewNFT')
}

const addCoins = () => {
  console.log('addCoins')
}

const withdrawCoins = () => {
  console.log('withdrawCoins')
}
</script>

<template>
  <div class="container coins">
    <ETabs
      :data="{ options: tabs, selected: activeTab }"
      @selected="switchTab"
      :style-config="{ underlineThickness: '2px' }"
    />
    <div class="tab-content" v-if="activeTab === 1">
      <div class="coins__header">
        <p class="coins__title">NFT</p>
      </div>
      <CoinsList :hand-amount="50" :bank-amount="45" />
      <EButton class="coins__btn" @click="emitNewNFT">Выпуск NFT</EButton>
    </div>

    <div class="tab-content" v-if="activeTab === 2">
      <div class="coins__header">
        <p class="coins__title">Монеты</p>
      </div>
      <CoinsList :hand-amount="23" :bank-amount="29">
        <template #default
          >Всего монет исторически: <span class="bold">452</span></template
        >
      </CoinsList>

      <div class="coins__actions">
        <EButton class="coins__btn" @click="addCoins">Добавить монеты</EButton>
        <EButton class="coins__btn" @click="withdrawCoins"
          >Вывод монет из оборота</EButton
        >
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.container {
}

.coins {
  color: $gray-700;

  &__header {
    margin-bottom: 15px;
  }
  &__title {
    font-weight: bold;
    font-size: 20px;
  }
  &__actions {
    display: flex;
    gap: 24px;
  }
  &__btn {
    margin-top: 20px;
  }
}

:deep(.tabs > .tabs-container) {
  .tab > .tab__name {
    font-size: 20px;
  }
}

.tab-content {
  margin-top: 30px;
  @include card();
  border-radius: 16px;
  padding: 16px;
  background: $base-white;
  min-width: 300px;
  max-width: fit-content;
}
.bold {
  font-weight: bold;
}
</style>
