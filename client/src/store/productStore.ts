import { defineStore } from 'pinia'
import API from '@/api/Http'
import { API_URL } from '@/helpers/globalVariables'
import { IProduct } from '@/types/interfaces'

interface ProductStoreState {
  products: IProduct[]
}

export const useProductStore = defineStore('useProductStore', {
  state: (): ProductStoreState => {
    return {
      products: [],
    }
  },

  actions: {
    async getProducts() {
      return await API.Http('get', `${API_URL}/product`, true, {}, {})
        .then(({ data }) => {
          this.products = data
        })
        .catch((error) => {
          throw new error()
        })
    },
  },
})
