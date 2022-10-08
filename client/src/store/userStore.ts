import { defineStore } from 'pinia'
import { UserAPI } from '@/api/UserAPI'
import { IAuthData } from '@/types/interfaces'
import { useCookies } from 'vue3-cookies'

const { cookies } = useCookies()

interface UserStoreState {
  user: any
}

export const useUserStore = defineStore('userStore', {
  state: (): UserStoreState => {
    return {
      user: {},
    }
  },

  actions: {
    async login(authData: IAuthData) {
      return UserAPI.login(authData)
    },
  },

  getters: {
    isLoggedIn() {
      return !!cookies.get('core')
    },
  },
})
