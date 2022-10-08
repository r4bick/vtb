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
      cookies.remove('bearer')

      return UserAPI.login(authData)
        .then((response) => {
          cookies.set('bearer', response.access_token)
        })
        .catch((error) => {
          throw error
        })
    },
  },

  getters: {
    isLoggedIn() {
      return !!cookies.get('bearer')
    },
  },
})
