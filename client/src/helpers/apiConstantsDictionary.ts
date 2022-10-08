import { TaskDirections, TaskTypes } from '@/types/enums'
type ConstantsIndexSignature<T> = { [key: string]: T }

export const taskTypeAPIConstants: ConstantsIndexSignature<TaskTypes> = {
  user: TaskTypes.Individual,
  departure: TaskTypes.Collective,
}

export const taskDirectionsAPIConstants: ConstantsIndexSignature<TaskDirections> =
  {
    publication: TaskDirections.Community,
    mentoring: TaskDirections.Mentoring,
    meetup: TaskDirections.Meetup,
    community: TaskDirections.Community,
    education: TaskDirections.Education,
  }

export const productTypeAPIConstants: ConstantsIndexSignature<string> = {
  physical: 'мерч компании',
  digital: 'подписки на сервисы',
}
