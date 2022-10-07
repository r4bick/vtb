<script setup lang="ts">
import { BadgeToggle, TaskCard } from '@/components'
import { TaskDirections, TaskTypes } from '@/types/enums'
import { ref, reactive } from 'vue'

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
  <div class="tasks">
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

    <div class="tasks-list">
      <TaskCard class="tasks-list__task" v-for="n in 10" :key="n" />
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.tasks {
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

  .tasks-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 24px;
    grid-row-gap: 32px;
    margin-top: 64px;

    &__task {
      //flex: 1 1 25%;
    }
  }
}
</style>
