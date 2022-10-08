import { API_URL } from '@/helpers/globalVariables'
import API from '@/api/Http'

class TaskAPIModel {
  async getTasks() {
    return await API.Http(
      'GET',
      `${API_URL}/task`,
      true,
      {},
      {
        withs: ['author.account', 'validator.account'],
      },
    )
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }

  async acceptTask(id: string) {
    return await API.Http('POST', `${API_URL}/task`, true, { id })
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }
}

export const TaskAPI = new TaskAPIModel()
