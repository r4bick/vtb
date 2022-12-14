export enum UserRoles {
  Employee = 'employee',
  HR = 'hr',
}

export enum TaskTypes {
  Collective = 'коллективная',
  Individual = 'индивидуальная',
  All = 'все',
}

export enum TaskImages {
  Planet = 'planet',
  Planet2 = 'planet2',
  Star = 'star',
  Telescope = 'telescope',
  Comet = 'comet',
}

export enum TaskDirections {
  Education = 'обучение',
  Mentoring = 'наставничество',
  Community = 'комьюнити',
  Meetup = 'митап',
  All = 'все',
}

export enum TaskStatuses {
  Open = 'open',
  InProcess = 'in_processed',
  Done = 'done',
  Completed = 'completed',
  Rejected = 'rejected',
}

export enum GoodCategories {
  Merch = 'мерч компании',
  Courses = 'обучающие курсы',
  Sport = 'абонементы на спорт',
  Concerts = 'концерты',
  ServiceSubscriptions = 'подписки на сервисы',
  ForWork = 'для комфортной работы',
}

export enum GoodTypes {
  Physical = 'физический',
  Digital = 'виртуальный',
}

export enum cryptoCurrency {
  Matic = 'matic',
  Ruble = 'ruble',
}

export const MAIN_CHAIN = '0x13881' // Chain Polygon Mumbai testnet

export enum CareerTrackStatus {
  Completed = 'completed',
  InProgress = 'progress',
  Future = 'future',
}
