import { API_URL } from '@/helpers/globalVariables'
import API from '@/api/Http'

class OrderAPIModel {
  async createOrder(product_id: string, user_id: string) {
    const requestData = {
      attributes: {
        product_id,
        user_id,
      },
    }

    return await API.Http('POST', `${API_URL}/order`, true, requestData)
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }
}

export const OrderAPI = new OrderAPIModel()
