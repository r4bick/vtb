import { defineStore } from 'pinia'
import { IProduct } from '@/types/interfaces'
import { ProductAPI } from '@/api/ProductAPI'

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
      return ProductAPI.getProducts()
        .then((products) => {
          this.products = products
        })
        .catch((error) => {
          throw error
        })
    },
  },
})
