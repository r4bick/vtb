import { defineStore } from 'pinia'
import { UserAPI } from '@/api/UserAPI'
import { IAuthData, IUser } from '@/types/interfaces'
import { useCookies } from 'vue3-cookies'
import API from '@/api/Http'
import { API_URL } from '@/helpers/globalVariables'
import { WalletAPI } from '@/api/WalletAPI'

const { cookies } = useCookies()

interface UserStoreState {
  currentUser: IUser
  user: any
  userList: IUser[]
}

export const useUserStore = defineStore('userStore', {
  state: (): UserStoreState => {
    return {
      currentUser: {} as IUser,
      user: {},
      userList: [],
    }
  },

  actions: {
    async getUserById(id: string) {
      return await API.Http(
        'get',
        `${API_URL}/user/${id}`,
        true,
        {},
        {
          withs: ['wallet', 'account'],
        },
      ).then(({ data }) => {
        this.user = data
        return data
      })
    },

    async getCurrentUser() {
      return await API.Http('get', `${API_URL}/user/me`, true).then(
        ({ data }) => {
          cookies.set('id', data.id)
          this.currentUser = data
          return data
        },
      )
    },

    async login(authData: IAuthData) {
      console.log(1)
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

    async logout() {
      cookies.remove('bearer')
    },

    async getAllUsers() {
      return UserAPI.getAll()
        .then((users) => {
          this.userList = users
        })
        .catch((error) => {
          throw error
        })
    },

    async sendCurrency(publicKey: string, amount: number | string) {
      return WalletAPI.sendCurrency(publicKey, Number(amount)).catch(
        (error) => {
          throw error
        },
      )
    },
  },

  getters: {
    isLoggedIn() {
      return !!cookies.get('bearer')
    },
  },
})
