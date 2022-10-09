<script setup lang="ts">
import { inputStyleConfigWhiteOutline } from '@/assets/EgalStyles/EInput'
import { orangeButton } from '@/assets/EgalStyles/EButton'
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { reactive, ref, computed } from 'vue'
import { IAuthData } from '@/types/interfaces'
import { useUserStore } from '@/store/userStore'
import { useRouter } from 'vue-router'
import { errorDictionary } from '@/helpers/errorDictionary'

import { useCookies } from 'vue3-cookies'
import { useEthereum } from '@/composables/useEthereum'
const { cookies } = useCookies()
const { getBalance } = useEthereum()
const userStore = useUserStore()
const router = useRouter()

const authData = reactive<IAuthData>({
  email: '',
  password: '',
})
const apiError = ref('')

const isSubmitDisabled = computed(() => {
  return !authData.email || !authData.password || !!apiError.value
})

const login = () => {
  console.log('g')
  userStore
    .login(authData)
    .then(async () => {
      await router.push('/tasks')
      const currentUser = await userStore.getCurrentUser()

      const currentUserDetails = await userStore.getUserById(currentUser.id)

      cookies.set('public', currentUserDetails.wallet.public_key)
      await getBalance()
    })
    .catch((error) => {
      apiError.value = errorDictionary[error.error]
    })
}
</script>

<template>
  <div class="sign-in">
    <h1 class="sign-in__title">Выход в космос ВТБ</h1>
    <div class="form">
      <EInput
        class="form__input"
        :data="{
          ...inputDataConfig,
          label: 'Почта',
          placeholder: 'Введите почту',
          modelValue: authData.email,
          error: apiError,
        }"
        :style-config="inputStyleConfigWhiteOutline"
        @update:modelValue="
          (value) => {
            apiError = ''
            authData.email = value
          }
        "
      />
      <EInput
        class="form__input"
        :data="{
          ...inputDataConfig,
          label: 'Пароль',
          placeholder: 'Введите пароль',
          modelValue: authData.password,
          type: 'password',
        }"
        :style-config="inputStyleConfigWhiteOutline"
        @update:modelValue="
          (value) => {
            apiError = ''
            authData.password = value
          }
        "
      />
      <EButton
        class="form__submit"
        :data="{ size: 'lg', disabled: isSubmitDisabled }"
        :style-config="orangeButton"
        @click="login"
      >
        Выйти
      </EButton>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.sign-in {
  &__title {
    @include h2();
    color: $base-white;
  }
  .form {
    display: flex;
    flex-direction: column;
    gap: 24px;
    width: 300px;
    margin-top: 32px;

    &__submit {
      width: fit-content;
      padding-left: 46px;
      padding-right: 46px;
      margin-top: 8px;
    }
  }
}
</style>
