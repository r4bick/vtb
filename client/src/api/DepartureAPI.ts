import { API_URL } from '@/helpers/globalVariables'
import API from '@/api/Http'

class DepartureAPIModel {
  async getAll() {
    return API.Http('GET', `${API_URL}/departure`, true)
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }
}

export const DepartureAPI = new DepartureAPIModel()
