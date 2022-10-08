import { defineStore } from 'pinia'
import { ITask } from '@/types/interfaces'
import { TaskAPI } from '@/api/TaskAPI'

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
      return TaskAPI.getTasks()
        .then((tasks) => {
          this.tasks = tasks
        })
        .catch((error) => {
          throw error
        })
    },

    async acceptTask(taskId: string) {
      return TaskAPI.acceptTask(taskId).catch((error) => {
        throw error
      })
    },
  },
})
