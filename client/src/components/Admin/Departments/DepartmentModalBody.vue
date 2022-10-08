<script setup lang="ts">
import { defineEmits, defineProps, PropType, reactive, watchEffect } from 'vue'
import { inputStyleConfig } from '@/assets/EgalStyles/EInput'
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { IDepartment } from '@/types/department/interfaces'
import ModalWindow from '@/components/Modal/ModalWindow.vue'

const emit = defineEmits(['close', 'save'])
const props = defineProps({
  editMode: { type: Boolean },
  item: { type: Object as PropType<IDepartment> },
  open: { type: Boolean },
})

const currentDep = reactive<IDepartment>({
  name: '',
  parent: '',
  child: '',
  chiefId: '',
})

watchEffect(() => {
  if (props.item && Object.keys(props.item).length > 0) {
    currentDep.id = props.item.id
    currentDep.name = props.item.name
    currentDep.parent = props.item.parent
    currentDep.child = props.item.child
    currentDep.chiefId = props.item.chiefId
  }
})
const onClose = () => {
  Object.keys(currentDep).forEach((key) => {
    //@ts-ignore
    currentDep[key] = ''
  })
  emit('close')
}

const emitSave = () => {
  const isEmpty = !Object.values(currentDep).some((x) => x !== null && x !== '')

  isEmpty ? emit('close') : emit('save', currentDep)
}
</script>

<template>
  <Teleport to="body">
    <ModalWindow :show="open" @close="onClose">
      <template #header>
        <div class="departments__modal-header">
          {{ editMode ? 'Редактировать отдел' : 'Создать отдел' }}
        </div>
      </template>
      <template #body>
        <div class="form">
          <ESelect
            class="form__select form__field"
            :data="{
              label: 'Родительский отдел',
              placeholder: 'Выберите Родительский отдел',
              modelValue: { name: currentDep.parent },
              options: [
                {
                  name: 'd',
                  value: 'd',
                },
              ],
              // nonlocalOptions: rKeeperDishesOptions,
              // searchable: true,
              // showMoreButtonDisplay: true,
              // showMoreButtonText: 'Показать больше...',
              // isLocalOptions: false,
              // nonLocalOptionsTotalCount: rKeeperDishesPagination.totalCount,
            }"
            @update:modelValue="
              (option) => (currentDep.parent = option[0].name)
            "
          />
          <ESelect
            class="form__select form__field"
            :data="{
              label: 'Дочерний отдел',
              placeholder: 'Выберите Дочерний отдел',
              modelValue: { name: currentDep.child },
              options: [
                {
                  name: '1',
                  value: 1,
                },
                {
                  name: '2',
                  value: 2,
                },
              ],
              // nonlocalOptions: rKeeperDishesOptions,
              // searchable: true,
              // showMoreButtonDisplay: true,
              // showMoreButtonText: 'Показать больше...',
              // isLocalOptions: false,
              // nonLocalOptionsTotalCount: rKeeperDishesPagination.totalCount,
            }"
            @update:modelValue="(option) => (currentDep.child = option[0].name)"
          />
          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'Название',
              modelValue: currentDep.name,
            }"
            :style-config="inputStyleConfig"
            v-model="currentDep.name"
          />
          <EInput
            class="form__input form__field"
            :data="{
              ...inputDataConfig,
              label: 'ID начальника',
              modelValue: currentDep.chiefId,
            }"
            :style-config="inputStyleConfig"
            v-model="currentDep.chiefId"
          />
        </div>
      </template>
      <template #footer>
        <div class="departments__modal-footer">
          <EButton @click="onClose">Отменить</EButton>
          <EButton @click="emitSave">Сохранить</EButton>
        </div>
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
  &__modal-footer {
    display: flex;
    justify-content: space-between;
    margin-top: 25px;
  }
}
</style>
