import axios from 'axios'
import API from '../Http'
import { API_URL } from '@/helpers/globalVariables'

class TaskAPIModel {
  async addTask(data: any) {
    return API.Http('post', `${API_URL}/task`, true, data)
      .then((resp) => {
        console.log(resp.data)
        return resp.data
      })
      .catch((error) => {
        throw error.response.data
      })
  }
}

export const TaskAPI = new TaskAPIModel()
