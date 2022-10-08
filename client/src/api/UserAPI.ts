import { IAuthData } from '@/types/interfaces'
import axios from 'axios'

class UserAPIModel {
  async login(data: IAuthData) {
    return axios
      .post(`${process.env.VUE_APP_BASE_URL}/auth/login`, data)
      .then((resp) => resp.data)
      .catch((error) => {
        throw error.response.data
      })
  }
}

export const UserAPI = new UserAPIModel()
