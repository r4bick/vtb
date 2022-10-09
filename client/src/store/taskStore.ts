import { defineStore } from 'pinia'
import { ITask } from '@/types/interfaces'
import { TaskAPI } from '@/api/TaskAPI'
import { TaskStatuses } from '@/types/enums'
import { useUserStore } from '@/store/userStore'

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
      const userId = useUserStore().currentUser.id
      return TaskAPI.acceptTask(taskId, userId).catch((error) => {
        throw error
      })
    },

    async changeStatus(taskId: string, status: TaskStatuses) {
      return TaskAPI.changeStatus(taskId, status).catch((error) => {
        throw error
      })
    },
  },
})
