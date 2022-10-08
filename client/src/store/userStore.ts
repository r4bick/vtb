import { defineStore } from 'pinia'
import { UserAPI } from '@/api/UserAPI'
import { IAuthData } from '@/types/interfaces'
import { useCookies } from 'vue3-cookies'
import API from '@/api/Http'

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
    async getUserById(id: string) {
      return await API.Http(
        'get',
        `${process.env.VUE_APP_API_BASE_URL}/user/${id}`,
        true,
        {},
        {
          withs: ['wallet'],
        },
      ).then(({ data }) => {
        return data
      })
    },
    async getCurrentUser() {
      return await API.Http(
        'get',
        `${process.env.VUE_APP_API_BASE_URL}/user/me`,
        true,
      ).then(({ data }) => {
        cookies.set('id', data.id)
        return data
      })
    },
    async login(authData: IAuthData) {
      cookies.remove('bearer')

      return UserAPI.login(authData)
        .then((response) => {
          //@ts-ignore
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
