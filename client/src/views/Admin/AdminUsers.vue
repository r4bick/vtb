<script setup lang="ts">
import { onMounted, reactive, ref } from 'vue'
import { useUserStore } from '@/store/userStore'
import ModalWindow from '@/components/Modal/ModalWindow.vue'
import { primaryButton } from '@/assets/EgalStyles/EButton'
import { inputDataConfig } from '@/assets/EgalData/EInput'

const userStore = useUserStore()
onMounted(() => {
  userStore.getAllUsers()
})

const currency = reactive({
  to: '',
  amount: '',
})
const isOpenModal = ref(false)
const openModal = (key: string) => {
  currency.to = key
  isOpenModal.value = true
  console.log('открыть модалку с инпутом')
}
const closeModal = () => {
  isOpenModal.value = false
  currency.to = ''
  currency.amount = ''
}

const sendCoins = () => {
  console.log(currency)
  if (!currency.to || !currency.amount) return

  userStore.sendCurrency(currency.to, currency.amount).then(() => {
    isOpenModal.value = false
  })
}
</script>

<template>
  <div class="container users">
    <div class="users__header">
      <p class="users__title">Список пользователей</p>
    </div>
    <div class="users__list" v-for="user in userStore.userList" :key="user.id">
      <div class="users__body">
        <div class="users__header">
          {{ user.account.first_name }} {{ user.account.last_name }}
        </div>
        <div class="users__body">{{ user.email }}</div>
      </div>

      <EButton @click="openModal(user.wallet.public_key)"
        >Перевести монеты</EButton
      >
    </div>
  </div>

  <ModalWindow
    class="modal modal--send-currency"
    :show="isOpenModal"
    @click.stop
    @close="closeModal"
  >
    <template #header>
      <span class="title">Перевод</span>
    </template>
    <template #body>
      <div class="modal-body">
        <div class="modal-form">
          <EInput
            class="modal-form__input"
            :data="{
              ...inputDataConfig,
              placeholder: 'Сумма перевода',
              modelValue: currency.amount,
              type: 'number',
            }"
            v-model="currency.amount"
          />
        </div>
        <EButton
          class="modal-body__submit"
          :style-config="primaryButton"
          @click="sendCoins"
        >
          Перевести
        </EButton>
      </div>
    </template>
  </ModalWindow>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';
.container {
}

.users {
  color: $gray-700;
  &__list {
    margin-top: 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    @include card();

    padding: 24px;
    background: $base-white;
  }
  &__header {
    display: flex;
    justify-content: space-between;
  }
  &__title {
    font-weight: bold;
    font-size: 20px;
  }
  &__body {
    display: flex;
    flex-direction: column;
    gap: 16px;
    color: $gray-700;
  }
  &__header {
    font-size: 20px;
    font-weight: 700;
  }
}

.modal--send-currency {
  .modal-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: center;
    align-items: flex-start;
    margin-top: 20px;
  }
  :deep(.modal-footer) {
    margin-top: 0;
  }
}
</style>
