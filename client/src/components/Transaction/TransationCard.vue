<script setup lang="ts">
import { computed, defineProps } from 'vue'
import { useCookies } from 'vue3-cookies'
import { timestampToDate } from '@/helpers/formatters'

interface TransactionCardProps {
  transaction: Record<string, any>
}
const props = defineProps<TransactionCardProps>()

const { cookies } = useCookies()
const formatDate = computed(() => {
  return timestampToDate(props.transaction.timeStamp)
})

const getAmount = computed(() => {
  return (props.transaction.value / 1e8).toFixed(2)
})

const getStatus = computed(() => {
  const key = cookies.get('public')
  return props.transaction.from.toLowerCase() === key.toLowerCase() ? -1 : 1
})
</script>

<template>
  <div class="card-transaction">
    <div class="card__header">
      <div class="card__status" :class="[getStatus > 0 ? 'income' : 'outcome']">
        {{ getStatus > 0 ? 'Поступление' : 'Списание' }}
      </div>
      <div class="card__main">{{ getAmount }} &#8381;</div>
    </div>
    <div class="card__footer">
      {{ formatDate }}
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.card-transaction {
  position: relative;
  @include card();
  display: flex;
  flex-direction: column;
  padding: 16px;
  background: $base-white;
  font-weight: 700;
  color: $gray-600;
}
.card {
  &__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 3px;
  }
  &__status {
    padding: 4px 8px;
    font-weight: 700;
    font-size: 16px;
    line-height: 22px;
    color: #ffffff;
    border-radius: 8px;
    margin-bottom: 2px;
    &.income {
      background: $success;
    }
    &.outcome {
      background: $danger;
    }
  }
  &__main {
    font-size: 24px;
    line-height: 33px;
  }
  &__footer {
    font-size: 14px;
    line-height: 19px;
  }
}
</style>
