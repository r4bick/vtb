import { defineStore } from 'pinia'
import API from '@/api/Http'
import { ITask } from '@/types/interfaces'
import { API_URL } from '@/helpers/globalVariables'

interface TaskStoreState {
  tasks: ITask[]
}

export const useTaskStore = defineStore('useTaskStore', {
  state: (): TaskStoreState => {
    return {
      tasks: [],
    }
  },

  actions: {
    async getTasks() {
      return await API.Http(
        'get',
        `${API_URL}/task`,
        true,
        {},
        {
          withs: ['author.account', 'validator.account'],
        },
      )
        .then(({ data }) => {
          this.tasks = data
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },
})
