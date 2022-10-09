import { IAuthData } from '@/types/interfaces'
import axios from 'axios'
import { API_URL } from '@/helpers/globalVariables'
import API from '@/api/Http'

class UserAPIModel {
  async login(data: IAuthData) {
    return axios
      .post(`${API_URL}/auth/login`, data)
      .then((resp) => resp.data)
      .catch((error) => {
        throw error.response.data
      })
  }

  async getAll() {
    return await API.Http(
      'GET',
      `${API_URL}/user`,
      true,
      {},
      { withs: ['account', 'wallet'] },
    )
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }
}

export const UserAPI = new UserAPIModel()
