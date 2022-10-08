import { API_URL } from '@/helpers/globalVariables'
import API from '@/api/Http'

class ProductAPIModel {
  async getProducts() {
    return await API.Http('get', `${API_URL}/product`, true, {}, {})
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw new error()
      })
  }

  async sendGift(email: string) {
    return await API.Http('POST', `${API_URL}/task`, true, { email })
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }
}

export const ProductAPI = new ProductAPIModel()
