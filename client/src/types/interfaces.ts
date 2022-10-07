import { UserRoles } from '@/types/enums'

export interface IAuthData {
  email: string
  password: string
}

export interface IUser {
  id: string
  email: string
  name: string
  surname: string
  role: UserRoles
  middle_name?: string
}
