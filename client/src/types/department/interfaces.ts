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
  name: string
  description: string
  files?: string[]
  validator_id: string
  end_at: string
  reward: string
  category: TaskDirections
  type: TaskTypes
}
