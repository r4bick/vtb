<script setup lang="ts">
import { defineEmits, defineProps, PropType, reactive, watchEffect } from 'vue'
import { inputStyleConfig } from '@/assets/EgalStyles/EInput'
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { ITask } from '@/types/department/interfaces'
import ModalWindow from '@/components/Modal/ModalWindow.vue'
import { secondaryButton } from '@/assets/EgalStyles/EButton'
import { TaskDirections, TaskTypes } from '@/types/enums'
import ETextArea from '@/components/Egal/TextArea/ETextArea.vue'

const emit = defineEmits(['close', 'save'])
const props = defineProps({
  editMode: { type: Boolean },
  item: { type: Object as PropType<ITask> },
  open: { type: Boolean },
})

const currentTask = reactive<ITask>({
  title: '',
  description: '',
  validatorID: '',
  deadlines: '',
  prize: '',
  category: TaskDirections.Conference,
  type: TaskTypes.Collective,
})

const taskCategories = [
  {
    name: TaskDirections.Conference,
  },
  {
    name: TaskDirections.CorporateEvents,
  },
  {
    name: TaskDirections.Education,
  },
  {
    name: TaskDirections.Sport,
  },
  {
    name: TaskDirections.Mentoring,
  },
  {
    name: TaskDirections.SocialProjects,
  },
]

const taskTypes = [
  { name: TaskTypes.Collective },
  { name: TaskTypes.Individual },
]
watchEffect(() => {
  if (props.item && Object.keys(props.item).length > 0) {
    currentTask.id = props.item.id
    currentTask.title = props.item.title
    currentTask.description = props.item.description
    currentTask.validatorID = props.item.validatorID
    currentTask.deadlines = props.item.deadlines
    currentTask.prize = props.item.prize
    currentTask.category = props.item.category
    currentTask.type = props.item.type
  }
})
const onClose = () => {
  Object.keys(currentTask).forEach((key) => {
    //@ts-ignore
    currentTask[key] = ''
  })
  emit('close')
}

const emitSave = () => {
  const isEmpty = !Object.values(currentTask).some(
    (x) => x !== null && x !== '',
  )

  isEmpty ? emit('close') : emit('save', currentTask)
}
</script>

<template>
  <Teleport to="body">
    <ModalWindow :show="open" @close="onClose">
      <template #header>
        <div class="departments__modal-header">
          {{ editMode ? 'Редактировать задачу' : 'Создать задачу' }}
        </div>
      </template>
      <template #body>
        <div class="form">
          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'Название',
              modelValue: currentTask.title,
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.title"
          />

          <ETextArea
            :data="{
              label: 'Описание',
              modelValue: currentTask.description,
            }"
          ></ETextArea>
          <!--          todo files -->
          <EFileUploader :data="{ label: 'Вложенные файлы' }" />
          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'ID сотрудника/ов валидаторов',
              modelValue: currentTask.validatorID,
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.validatorID"
          />

          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'Сроки задачи',
              modelValue: currentTask.deadlines,
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.deadlines"
          />
          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'Награда',
              modelValue: currentTask.prize,
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.prize"
          />
          <ESelect
            class="form__select form__field"
            :data="{
              label: 'Категория задачи',
              placeholder: 'Выберите категорию',
              modelValue: { name: currentTask.category },
              options: taskCategories,
            }"
            @update:modelValue="
              (option) => (currentTask.category = option[0].name)
            "
          />
          <ESelect
            class="form__select form__field"
            :data="{
              label: 'Тип задачи',
              placeholder: 'Выберите тип задачи',
              modelValue: { name: currentTask.type },
              options: taskTypes,
            }"
            @update:modelValue="(option) => (currentTask.type = option[0].name)"
          />
        </div>
      </template>
      <template #footer>
        <EButton @click="emitSave">Сохранить</EButton>
        <EButton @click="onClose" :style="secondaryButton">Отменить</EButton>
      </template>
    </ModalWindow>
  </Teleport>
</template>

<style scoped lang="scss">
.form {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-top: 30px;
}

.departments {
}
</style>
