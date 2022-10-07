<script setup lang="ts">
import { inputStyleConfig } from '@/assets/EgalStyles/EInput'
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { reactive } from 'vue'
import { IAuthData } from '@/types/interfaces'
import { useUserStore } from '@/store/userStore'

const userStore = useUserStore()

const authData = reactive<IAuthData>({
  email: '',
  password: '',
})

const login = () => {
  userStore.login(authData)
}
</script>

<template>
  <div class="sign-in">
    <div class="form">
      <EInput
        class="form__input"
        :data="{
          ...inputDataConfig,
          label: 'email',
          modelValue: authData.email,
        }"
        :style-config="inputStyleConfig"
        v-model="authData.email"
      />
      <EInput
        class="form__input"
        :data="{
          ...inputDataConfig,
          label: 'password',
          modelValue: authData.password,
        }"
        :style-config="inputStyleConfig"
        v-model="authData.password"
      />
      <EButton class="form__submin" @click="login">Sign In</EButton>
    </div>
  </div>
</template>

<style scoped lang="scss">
.sign-in {
  display: flex;
  justify-content: center;

  .form {
    margin-top: 150px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 300px;
  }
}
</style>
