import { defineStore } from 'pinia'
interface UserStoreState {
  user: any
}

export const useUserStore = defineStore('userStore', {
  state: (): UserStoreState => {
    return {
      user: {},
    }
  },

  actions: {},

  getters: {},
})
