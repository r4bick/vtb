<script setup lang="ts">
import {
  computed,
  defineEmits,
  defineProps,
  onMounted,
  PropType,
  reactive,
  ref,
  watchEffect,
} from 'vue'
import { inputStyleConfig } from '@/assets/EgalStyles/EInput'
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { ITask } from '@/types/department/interfaces'
import ModalWindow from '@/components/Modal/ModalWindow.vue'
import { secondaryButton } from '@/assets/EgalStyles/EButton'
import { TaskDirections, TaskTypes } from '@/types/enums'
import ETextArea from '@/components/Egal/TextArea/ETextArea.vue'
import { useCookies } from 'vue3-cookies'
import { required } from '@/helpers/validators'
const emit = defineEmits(['close', 'save'])
const props = defineProps({
  editMode: { type: Boolean },
  item: { type: Object as PropType<ITask> },
  open: { type: Boolean },
})

const currentTask = reactive<ITask>({
  name: '',
  description: '',
  validator_id: '',
  end_at: '',
  reward: '',
  category: TaskDirections.Learning,
  type: TaskTypes.Collective,
})

const taskCategories = [
  {
    name: TaskDirections.Learning,
    value: 'education',
  },
  {
    name: TaskDirections.Mentoring,
    value: 'mentoring',
  },
  {
    name: TaskDirections.Community,
    value: 'community',
  },
  {
    name: TaskDirections.Meetup,
    value: 'meetup',
  },
]
const selectedCategory = ref('education')
const selectedType = ref('departure')

const taskTypes = [
  { name: TaskTypes.Collective, value: 'departure' },
  { name: TaskTypes.Individual, value: 'user' },
]
watchEffect(() => {
  if (props.item && Object.keys(props.item).length > 0) {
    currentTask.id = props.item.id
    currentTask.name = props.item.name
    currentTask.description = props.item.description
    currentTask.validator_id = props.item.validator_id
    currentTask.end_at = props.item.end_at
    currentTask.reward = props.item.reward
    currentTask.category = props.item.category
    currentTask.type = props.item.type
  }
})

const isSubmitDisabled = computed(() => {
  return (
    !currentTask.name ||
    !currentTask.category ||
    !currentTask.type ||
    !currentTask.end_at ||
    !currentTask.validator_id ||
    !currentTask.reward
  )
})
const onClose = () => {
  Object.keys(currentTask).forEach((key) => {
    //@ts-ignore
    currentTask[key] = ''
  })
  emit('close')
}

const { cookies } = useCookies()
const formatDate = (date: string) => {
  const splited = date.split('.')
  return `${splited[2]}-${splited[1]}-${splited[0]}`
}
const emitSave = () => {
  const isEmpty = !Object.values(currentTask).some(
    (x) => x !== null && x !== '',
  )

  // const end_at = formatDate(currentTask.end_at)
  const today = new Date().toLocaleDateString().toString()
  const begin_at = formatDate(today)

  isEmpty
    ? emit('close')
    : emit('save', {
        ...currentTask,
        begin_at,
        // end_at,
        category: selectedCategory.value,
        type: selectedType.value,
        author_id: cookies.get('id'),
      })
}

onMounted(() => {
  Object.keys(currentTask).forEach((key) => {
    //@ts-ignore
    currentTask[key] = ''
  })
})
const updateType = (option: any) => {
  currentTask.type = option[0].name
  selectedType.value = option[0].value
}

const updateCat = (option: any) => {
  currentTask.category = option[0].name
  selectedCategory.value = option[0].value
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
              modelValue: currentTask.name,
              validators: [required],
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.name"
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
              modelValue: currentTask.validator_id,
              validators: [required],
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.validator_id"
          />

          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'Сроки задачи',
              modelValue: currentTask.end_at,
              validators: [required],
              type: 'date',
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.end_at"
          />

          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'Награда',
              modelValue: currentTask.reward,
              validators: [required],
            }"
            :style-config="inputStyleConfig"
            v-model="currentTask.reward"
          />
          <div class="combined">
            <ESelect
              class="form__select form__field"
              :data="{
                label: 'Категория задачи',
                placeholder: 'Выберите категорию',
                modelValue: { name: currentTask.category },
                options: taskCategories,
                validators: [required],
              }"
              @update:modelValue="updateCat"
            />
            <ESelect
              class="form__select form__field"
              :data="{
                label: 'Тип задачи',
                placeholder: 'Выберите тип задачи',
                modelValue: { name: currentTask.type },
                options: taskTypes,
                validators: [required],
              }"
              @update:modelValue="updateType"
            />
          </div>
        </div>
      </template>
      <template #footer>
        <EButton @click="emitSave" :data="{ disabled: isSubmitDisabled }"
          >Сохранить</EButton
        >
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

.combined {
  display: flex;
  gap: 20px;
}

:deep(.input-container) {
  input[type='date'] {
    color: #2d3748;
  }
}
</style>
