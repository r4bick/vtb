// Для интерфейсов связанных с отделами
import { TaskDirections, TaskTypes } from '@/types/enums'

export interface IDepartment {
  id?: string
  name: string
  parent: string
  child: string
  chiefId: string
}

// приблизительный интерфейс задачи
export interface ITask {
  id?: string
  title: string
  description: string
  files?: string[]
  validatorID: string
  deadlines: string
  prize: string
  category: TaskDirections
  type: TaskTypes
}
