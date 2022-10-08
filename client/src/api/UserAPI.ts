import { IAuthData } from '@/types/interfaces'
import axios from 'axios'
import { API_URL } from '@/helpers/globalVariables'

class UserAPIModel {
  async login(data: IAuthData) {
    return axios
      .post(`${API_URL}/auth/login`, data)
      .then((resp) => resp.data)
      .catch((error) => {
        throw error.response.data
      })
  }
}

export const UserAPI = new UserAPIModel()
