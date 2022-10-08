import axios from 'axios'
import API from '../Http'
class TaskAPIModel {
  async addTask(data: any) {
    return API.Http(
      'post',
      `${process.env.VUE_APP_API_BASE_URL}/task`,
      true,
      data,
    )
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
