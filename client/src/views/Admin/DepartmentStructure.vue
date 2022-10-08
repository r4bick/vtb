<script setup lang="ts">
import DepartmentItem from '@/components/Admin/Departments/DepartmentItem.vue'
import { ref } from 'vue'
import { IDepartment } from '@/types/department/interfaces'

import DepartmentModalBody from '@/components/Admin/Departments/DepartmentModalBody.vue'

const openModal = ref(false)
const isEditMode = ref(false)
const editItem = ref<IDepartment | undefined>(undefined)

const departments = ref<IDepartment[]>([
  { id: '0', name: 'nkfd', parent: 'dfgd', child: 'dfsdf', chiefId: '1' },
  { id: '3', name: 'n4kfd', parent: 'df34d', child: 'df345sdf', chiefId: '1' },
  { id: '2', name: 'ndtkfd', parent: 'dfg4d', child: 'dfsdf', chiefId: '1' },
])

const editDepartment = (item: IDepartment) => {
  editItem.value = item
  openModal.value = true
  isEditMode.value = true
}

const createDepartment = () => {
  editItem.value = undefined
  openModal.value = true
  isEditMode.value = false
}

const closeModal = () => {
  editItem.value = undefined
  openModal.value = false
  isEditMode.value = false
}

const saveChanges = (form: IDepartment) => {
  if (!isEditMode.value) {
    departments.value.push(form)
    closeModal()
    return
  }

  departments.value = departments.value.map((i) => {
    if (i.id === form.id) {
      return { ...i, ...form }
    } else return i
  })
  closeModal()
}

const deleteDepartment = (id: string) => {
  departments.value = departments.value.filter((i) => i.id !== id)
}

const updateDepartmentBalance = () => {
  //  update balance
}
</script>

<template>
  <div class="container departments">
    <div class="departments__header">
      <p class="departments__title">Список отделов</p>
      <EButton @click="createDepartment">Создать отдел</EButton>
    </div>
    <div class="departments__list" v-for="dep in departments" :key="dep.id">
      <DepartmentItem
        :item="dep"
        @edit="editDepartment(dep)"
        @delete="deleteDepartment(dep.id)"
        @updateBalance="updateDepartmentBalance"
      />
    </div>
  </div>

  <DepartmentModalBody
    :open="openModal"
    :edit-mode="isEditMode"
    :item="editItem"
    @close="closeModal"
    @save="saveChanges"
  />
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';

.container {
}

.departments {
  color: $gray-700;
  &__list {
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  &__header {
    display: flex;
    justify-content: space-between;
  }
  &__title {
    font-weight: bold;
    font-size: 20px;
  }
}
</style>
