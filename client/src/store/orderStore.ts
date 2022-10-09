import { defineStore } from 'pinia'
import { OrderAPI } from '@/api/OrderAPI'
import { useUserStore } from '@/store/userStore'

interface OrderStoreState {
  orders: unknown[]
}

export const useOrderStore = defineStore('userStore', {
  state: (): OrderStoreState => {
    return {
      orders: [],
    }
  },

  actions: {
    async createOrder(productId: string) {
      const userId = useUserStore().currentUser.id
      return OrderAPI.createOrder(productId, userId).catch((error) => {
        throw error
      })
    },
  },

  getters: {},
})
