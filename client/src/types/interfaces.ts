import { UserRoles } from '@/types/enums'

export interface IAuthData {
  email: string
  password: string
}

export interface IUser {
  id: string
  email: string //'edenesik@example.com'
  status: string //'active'
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
  status: string // TODO enum 'open'
  category: string
  reward: number
  author: IUser
  like_number: number
  dislike_number: number
  created_at: string
  updated_at: string
}

// author: {
//   id: '38fd17dc-331a-496e-a391-07ee7d7a14a4'
//   email: 'edenesik@example.com'
//   status: 'active'
//   created_at: '2022-10-08T12:55:21.000000Z'
//   updated_at: '2022-10-08T12:55:21.000000Z'
//   account: {
//     id: '38fd17dc-331a-496e-a391-07ee7d7a14a4'
//     first_name: 'Анна'
//     last_name: 'Кулаченков'
//     family_name: 'Николаевич'
//     level: '0'
//     departure_id: '85133bfe-27c4-45d3-92ae-44e1b75f3dbe'
//     created_at: '2022-10-08T12:55:22.000000Z'
//     updated_at: '2022-10-08T12:55:22.000000Z'
//   }
// }
// validator: {
//   id: '38fd17dc-331a-496e-a391-07ee7d7a14a4'
//   email: 'edenesik@example.com'
//   status: 'active'
//   created_at: '2022-10-08T12:55:21.000000Z'
//   updated_at: '2022-10-08T12:55:21.000000Z'
//   account: {
//     id: '38fd17dc-331a-496e-a391-07ee7d7a14a4'
//     first_name: 'Анна'
//     last_name: 'Кулаченков'
//     family_name: 'Николаевич'
//     level: '0'
//     departure_id: '85133bfe-27c4-45d3-92ae-44e1b75f3dbe'
//     created_at: '2022-10-08T12:55:22.000000Z'
//     updated_at: '2022-10-08T12:55:22.000000Z'
//   }
// }

export interface IHeaderLink {
  to: string
  label: string
}
