<script setup lang="ts">
import { BadgeToggle, TaskCard } from '@/components'
import { TaskDirections, TaskTypes } from '@/types/enums'
import { onMounted, ref } from 'vue'
import { useTaskStore } from '@/store/taskStore'

const taskStore = useTaskStore()

const selectedTaskType = ref<TaskTypes>(TaskTypes.All)
const selectedTaskDirections = ref<TaskDirections[]>([TaskDirections.All])

onMounted(() => {
  taskStore.getTasks()
})

const toggleTaskDirection = (direction: TaskDirections) => {
  if (direction === TaskDirections.All) {
    selectedTaskDirections.value = [TaskDirections.All]
    return
  } else if (selectedTaskDirections.value.includes(TaskDirections.All)) {
    selectedTaskDirections.value = []
  }

  const foundDirectionIndex = selectedTaskDirections.value.indexOf(direction)

  if (foundDirectionIndex === -1) {
    selectedTaskDirections.value.push(direction)
  } else {
    selectedTaskDirections.value.splice(foundDirectionIndex, 1)
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
      <TaskCard
        class="tasks-list__task"
        :name="task.name"
        :description="task.description"
        :end_at="task.end_at"
        :reward="task.reward"
        :author_email="task.author.email"
        :category="task.category"
        :type="task.type"
        :like_number="task.like_number"
        :dislike_number="task.dislike_number"
        :key="task.id"
        v-for="task in taskStore.tasks"
      />
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
