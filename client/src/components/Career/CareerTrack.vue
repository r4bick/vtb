3
<script setup lang="ts">
import { computed, defineProps, onMounted } from 'vue'
import CareerCard from '@/components/Career/CareerCard.vue'
import { CareerTrackStatus } from '@/types/enums'
import ArrowSVG from '@/components/SvgIcons/ArrowSVG.vue'
//
// interface NftCardProps {
//   title: string
//   image: string
// }
// const props = defineProps<NftCardProps>()
//
// const taskImage = computed(() => {
//   return require(`@/assets/img/nftcard/${props.image}.png`)
// })
</script>

<template>
  <div class="career-wrapper">
    <ArrowSVG class="arrow left" />

    <div class="track">
      <CareerCard
        class="career-card"
        :course-amount="8"
        :task-amount="10"
        :total-courses="8"
        :total-tasks="10"
        title="Java-разработчик джуниор"
        badge="достигнуто 21.01.2022"
        :category="1"
        :status="CareerTrackStatus.Completed"
      />
      <CareerCard
        class="career-card"
        :course-amount="8"
        :task-amount="10"
        :total-courses="10"
        :total-tasks="15"
        title="Java-разработчик джуниор"
        :category="2"
        :status="CareerTrackStatus.InProgress"
      />
      <CareerCard
        class="career-card"
        :course-amount="0"
        :task-amount="0"
        :total-courses="12"
        :total-tasks="20"
        title="Java-разработчик мидл"
        :category="3"
        badge="Выполните предыдущий грейд для перехода на этот
"
        :status="CareerTrackStatus.Future"
      />
    </div>
    <ArrowSVG class="arrow right" />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.career-wrapper {
  display: flex;

  align-items: center;
  gap: 50px;
}
.track {
  display: flex;
  gap: 74px;
}
.career-card {
  position: relative;
  &:last-child {
    &::before {
      width: 0;
    }
  }
}
.career-card::before {
  content: '';
  width: 74px;
  height: 5px;
  background: #a6c8fa;
  position: absolute;
  right: -74px;
  top: 50%;
}
.arrow {
  cursor: pointer;
  margin-bottom: 40px;
  &.right {
    transform: rotate(180deg);
  }
}
</style>
