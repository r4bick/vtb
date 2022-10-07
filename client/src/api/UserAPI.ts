// import { useCookies } from 'vue3-cookies'
import axios from 'axios'
import { IAuthData } from '@/types/interfaces'

// const { cookies } = useCookies()

class UserAPIModel {
  async login(data: IAuthData) {
    console.log(data)
  }
}

export const UserAPI = new UserAPIModel()
