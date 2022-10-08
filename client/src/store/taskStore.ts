import { defineStore } from 'pinia'
import API from '@/api/Http'
import { ITask } from '@/types/interfaces'

interface UserStoreState {
  tasks: ITask[]
}

export const useTaskStore = defineStore('useTaskStore', {
  state: (): UserStoreState => {
    return {
      tasks: [],
    }
  },

  actions: {
    async getTasks() {
      return await API.Http(
        'get',
        `${process.env.VUE_APP_API_BASE_URL}/task`,
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
