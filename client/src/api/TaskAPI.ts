import { API_URL } from '@/helpers/globalVariables'
import API from '@/api/Http'
import { TaskStatuses } from '@/types/enums'

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

  async acceptTask(task_id: string, user_id: string) {
    const requestData = {
      attributes: {
        task_id,
        user_id,
      },
    }

    return await API.Http('POST', `${API_URL}/task_user`, true, requestData)
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }

  async changeStatus(id: string, status: TaskStatuses) {
    const requestData = {
      attributes: {
        status,
      },
    }

    return await API.Http('PUT', `${API_URL}/task/${id}`, true, requestData)
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw error
      })
  }
}

export const TaskAPI = new TaskAPIModel()
