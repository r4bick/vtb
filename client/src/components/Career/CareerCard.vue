<script setup lang="ts">
import { defineProps } from 'vue'
import { CareerTrackStatus } from '@/types/enums'

interface NftCardProps {
  badge?: string
  title: string
  courseAmount: number
  taskAmount: number
  totalCourses: number
  totalTasks: number
  status: CareerTrackStatus
  category: number
}
const props = defineProps<NftCardProps>()

const getStatusColor = (): string[] => {
  if (props.status === CareerTrackStatus.Completed) {
    return ['#00834C', '#66CB9F']
  } else if (props.status === CareerTrackStatus.InProgress) {
    return ['#005CE4', '#0066FF']
  }
  return []
}

const config = {
  type: 'horizontal_bar',
  data: {
    datasets: [
      {
        label: 'Курсы',
        backgroundColor: getStatusColor()[0],
        data: [(props.courseAmount / props.totalCourses) * 100],
      },
      {
        label: 'Задания',
        backgroundColor: getStatusColor()[1],
        data: [(props.taskAmount / props.totalTasks) * 100],
      },
    ],
  },
  options: {
    emptyColor: '#e2e8f0',
    fontColor: '#2D3748',
    secondFontColor: '#A0AEC0',
    titleFontSize: '14px',
    labelsFontSize: '12px',
    fontWeight: 'bold',
    secondFontWeight: 'normal',
    thickness: props.status === CareerTrackStatus.InProgress ? 12 : 7,
    background: '#ffffff',
  },
}
</script>

<template>
  <div class="career" :class="status">
    <div class="career__badge" v-if="badge">{{ badge }}</div>
    <div class="career__title">
      <p>{{ title }}</p>
      <p>категория {{ category }}</p>
    </div>

    <div class="career__completed">
      <!--        todo обработать окончания (курсов, курсаб курс) -->
      <p class="career__courses">
        {{ courseAmount || `${courseAmount}/12` }} курсов пройдено
      </p>
      <p class="career__tasks">
        {{ taskAmount || `${taskAmount}/12` }} тасков пройдено
      </p>
    </div>
    <div class="career__achieve" v-if="status === CareerTrackStatus.InProgress">
      <p>Для достижения выполните</p>
      <p>митапы - 3</p>
      <p>статьи - 2</p>
    </div>
    <Chart :data="config" />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.career {
  position: relative;
  @include card();
  display: flex;
  flex-direction: column;
  padding: 24px;
  background: $base-white;
  height: fit-content;

  &__badge {
    padding: 4px 8px;
    border: 0.5px solid $gray-400;
    border-radius: 8px;
    font-weight: 700;
    font-size: 12px;
    line-height: 15px;
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: flex-start;
    width: fit-content;
    color: $gray-600;
    margin-bottom: 16px;
  }

  &__title {
    font-weight: 700;
    font-size: 18px;
    line-height: 22px;
    display: flex;
    align-items: flex-start;
    color: $gray-700;
    margin-bottom: 8px;
    flex-direction: column;
  }
  &__completed {
    font-weight: 700;
    font-size: 12px;
    line-height: 15px;
    display: flex;
    align-items: flex-start;
    color: $gray-700;
    flex-direction: column;
  }
  &__courses {
  }
  &__tasks {
  }
  &__achieve {
    margin-top: 24px;
    p {
      font-weight: 700;
      font-size: 12px;
      line-height: 18px;
      display: flex;
      align-items: center;
      color: $gray-600;
    }
  }

  //  statuses
  &.completed {
    width: 258px;
  }
  &.progress {
    width: 359px;
  }
  &.future {
    width: 341px;
    .career__title {
      color: $gray-600;
    }
    .career__completed {
      color: $gray-500;
    }
  }
}

.chart-wrapper {
  padding: 0 !important;
  border: none !important;
  box-shadow: none !important;
}

:deep(.charts) {
  .row {
    margin-bottom: 12px;
  }
}
:deep(.legend-item),
:deep(.chart-label > span) {
  display: none;
}
</style>
