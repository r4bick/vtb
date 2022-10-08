// Для интерфейсов связанных с отделами
export interface IDepartment {
  id?: string
  name: string
  parent: string
  child: string
  chiefId: string
}
