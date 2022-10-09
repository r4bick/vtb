<script setup lang="ts">
import { defineProps } from 'vue'
import BadgesCard from '@/components/BadgesCard/BadgesCard.vue'

interface VerticalCardProps {
  ratingIndex?: number
  showRating: boolean
  lastName: string
  firstName: string
  badges?: string[]
}
const props = defineProps<VerticalCardProps>()
</script>

<template>
  <div class="wrapper">
    <div class="leader-side">
      <span class="leader-side__rating" v-if="showRating">{{
        ratingIndex + 1
      }}</span>
      <img
        class="leader-side__astronaut"
        :src="require('@/assets/img/astronaut.svg')"
        alt="Astronaut"
      />
    </div>
    <div class="leader-body">
      <BadgesCard
        class="badge-card"
        :name="`${firstName} ${lastName}`"
        :badges="badges"
      />
      <div class="controls">
        <slot name="controls" />
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.wrapper {
  @include card();
  position: relative;
  padding: 24px 26px 24px 28px;
}
.leader-side {
  &__rating {
    position: absolute;
    font-style: normal;
    font-weight: 900;
    font-size: 52px;
    line-height: 63px;
    color: $pressed-secondary-vtb;
    top: 0;
    left: 9px;
    transform: translateY(-60%);
  }
  &__astronaut {
    position: absolute;
    top: 0;
    transform: translateY(-20%);
  }
}

.leader-body {
  display: flex;
  align-items: center;
  margin-left: 100px;

  .user-info {
    display: flex;
    gap: 16px;
    flex-direction: column;

    &__title {
      @include h3();
      color: $gray-800;
    }

    .badge-list {
      display: flex;
      gap: 9px;

      &__badge {
        @include badge();
      }
    }
  }

  .controls {
    display: flex;
    gap: 16px;
    margin-left: auto;
  }
}
//
//.wrapper {
//  position: relative;
//
//  .card {
//    position: relative;
//    @include card();
//    display: flex;
//
//    padding: 24px;
//    background: $base-white;
//
//    .header {
//      display: flex;
//      gap: 16px;
//    }
//
//    .image {
//      width: 115px;
//      margin-top: -70px;
//    }
//    .actions {
//      display: flex;
//      gap: 16px;
//      align-items: center;
//      margin-left: auto;
//      margin-right: 42px;
//    }
.badge-card {
  box-shadow: none;
  min-height: 0;
  padding: 0;
  margin-left: 20px;
}
//  }
//}
</style>
