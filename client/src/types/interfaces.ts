import { GoodTypes, TaskStatuses } from '@/types/enums'

export interface IAuthData {
  email: string
  password: string
}

export interface IUser {
  id: string
  email: string
  status: string
  account: IAccount
}

export interface IAccount {
  id: string
  first_name: string
  last_name: string
  family_name: string
  level: string | number
  departure_id: string
}

export interface ITask {
  id: string
  name: string
  description: string
  author_id: string
  validator_id: string
  begin_at: string
  end_at: string
  participant_number: number
  type: string
  status: TaskStatuses
  category: string
  reward: number
  author: IUser
  validator: IUser
  like_number: number
  dislike_number: number
  created_at: string
  updated_at: string
}

export interface IHeaderLink {
  to: string
  label: string
}

export interface IProduct {
  id: string
  name: string
  description: string
  photo: string
  price: number
  type: GoodTypes
  features: {
    size: string
    weight: string
    package: string
    material: string
  }
  created_at: string
  updated_at: string
}
