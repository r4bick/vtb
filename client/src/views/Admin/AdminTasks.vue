<script setup lang="ts">
import { reactive, ref } from 'vue'
import { ITask } from '@/types/department/interfaces'

import ModalWindow from '@/components/Modal/ModalWindow.vue'
import { secondaryButton } from '@/assets/EgalStyles/EButton'
import { TaskDirections, TaskTypes } from '@/types/enums'
import TaskItem from '@/components/Admin/Tasks/TaskItem.vue'

import TaskModalBody from '@/components/Admin/Tasks/TaskModalBody.vue'
import BadgeToggle from '@/components/BadgeToggle/BadgeToggle.vue'
import { TaskAPI } from '@/api/Admin/TaskAPI'

const openModal = ref(false)
const isEditMode = ref(false)
const editItem = ref<ITask | undefined>(undefined)

const tasks = ref<ITask[]>([
  {
    id: '0',
    name: 'Задача 1',
    description:
      'Сложная задача Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam deserunt dolorum esse, harum necessitatibus nobis quod ratione rerum. Maxime, voluptatum? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam deserunt dolorum esse, harum necessitatibus nobis quod ratione rerum. Maxime, voluptatum? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam deserunt dolorum esse, harum necessitatibus nobis quod ratione rerum. Maxime, voluptatum?',
    category: TaskDirections.Meetup,
    type: TaskTypes.Collective,
    validator_id: '123',
    end_at: '15.02.2022',
    reward: '2574',
  },
  {
    id: '1',
    name: 'Задача 2',
    description: 'Задача попроще',
    category: TaskDirections.Education,
    type: TaskTypes.Individual,
    validator_id: '123',
    end_at: '15.02.2022',
    reward: '24',
  },
  {
    id: '2',
    name: 'Задача 3',
    description: 'Совсем простая задача жесть',
    category: TaskDirections.Mentoring,
    type: TaskTypes.Individual,
    validator_id: '123',
    end_at: '15.02.2022',
    reward: '274',
  },
])

const editDepartment = (item: ITask) => {
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

const saveChanges = (form: ITask) => {
  if (!isEditMode.value) {
    console.log(form)
    tasks.value.push(form)
    TaskAPI.addTask({ attributes: form }).then(() => closeModal())

    return
  }

  tasks.value = tasks.value.map((i) => {
    if (i.id === form.id) {
      return { ...i, ...form }
    } else return i
  })
  closeModal()
}

const showDeleteModal = ref(false)
const currentId = ref('')
const openDeleteModal = (id: string): void => {
  showDeleteModal.value = true
  currentId.value = id
}
const confirmDeleteDepartment = () => {
  showDeleteModal.value = false
  tasks.value = tasks.value.filter((i) => i.id !== currentId.value)
  currentId.value = ''
}

// fitlers
const selectedTaskType = ref<TaskTypes>(TaskTypes.All)

const selectedTaskDirections = reactive<TaskDirections[]>([])
const toggleTaskDirection = (direction: TaskDirections) => {
  const foundDirectionIndex = selectedTaskDirections.indexOf(direction)

  if (foundDirectionIndex === -1) {
    selectedTaskDirections.push(direction)
  } else {
    selectedTaskDirections.splice(foundDirectionIndex, 1)
  }
}
</script>

<template>
  <div class="container tasks">
    <div class="tasks__header">
      <p class="tasks__title">Список задач</p>

      <EButton @click="createDepartment">Создать задачу</EButton>
    </div>
    <div class="filters">
      <div class="type-filter">
        <div class="badge-list">
          <p class="badge-list__title">Тип задачи</p>
          <div class="badge-list__list">
            <BadgeToggle
              :active="type === selectedTaskType"
              :key="type"
              v-for="type in TaskTypes"
              @click="selectedTaskType = type"
            >
              {{ type }}
            </BadgeToggle>
          </div>
        </div>
      </div>

      <div class="direction-filter">
        <div class="badge-list">
          <p class="badge-list__title">Направление</p>
          <div class="badge-list__list">
            <BadgeToggle
              :active="selectedTaskDirections.includes(direction)"
              :key="direction"
              v-for="direction in TaskDirections"
              @click="toggleTaskDirection(direction)"
            >
              {{ direction }}
            </BadgeToggle>
          </div>
        </div>
      </div>
    </div>
    <div class="tasks__list" v-for="task in tasks" :key="task.id">
      <TaskItem
        :item="task"
        @edit="editDepartment(task)"
        @delete="openDeleteModal(task.id)"
      />
    </div>
  </div>

  <TaskModalBody
    :open="openModal"
    :edit-mode="isEditMode"
    :item="editItem"
    @close="closeModal"
    @save="saveChanges"
  />
  <!-- Удаление отдела -->
  <Teleport to="body">
    <ModalWindow
      class="delete-modal"
      :show="showDeleteModal"
      @close="showDeleteModal = false"
      :show-close-icon="false"
    >
      <template #header>
        <p>Вы уверены, что хотите удалить отдел?</p>
      </template>

      <template #footer>
        <EButton @click="confirmDeleteDepartment">Удалить</EButton>
        <EButton
          :style-config="secondaryButton"
          @click="showDeleteModal = false"
          >Отмена</EButton
        >
      </template>
    </ModalWindow>
  </Teleport>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';
.container {
}

.tasks {
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

.delete-modal {
  :deep(.modal-container) {
    width: fit-content;
  }
}

// filters
.filters {
  margin-top: 10px;
  margin-bottom: 40px;
}
.type-filter,
.direction-filter {
  .badge-list {
    &__title {
      @include h5();
    }

    &__list {
      display: flex;
      gap: 16px;
      margin-top: 16px;
    }
  }
}

.direction-filter {
  margin-top: 24px;
}
</style>
