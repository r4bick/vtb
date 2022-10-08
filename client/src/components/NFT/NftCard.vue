<script setup lang="ts">
import { computed, defineProps, onMounted } from 'vue'

import { OnClickOutside } from '@vueuse/components'

interface NftCardProps {
  title: string
  image: string
}
const props = defineProps<NftCardProps>()

const taskImage = computed(() => {
  return require(`@/assets/img/nftcard/${props.image}.png`)
})
</script>

<template>
  <OnClickOutside>
    <div class="task-card">
      <div class="card">
        <div class="body">
          <img class="body__image" :src="taskImage" alt="Task image" />
        </div>
        <div class="footer">
          {{ title }}
        </div>
      </div>
    </div>
  </OnClickOutside>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.task-card {
  position: relative;

  .card {
    position: relative;
    @include card();
    display: flex;
    flex-direction: column;
    min-width: 320px;
    min-height: 255px;
    padding: 16px;
    background: $base-white;

    .header {
      display: flex;
      gap: 16px;
    }

    .body {
      margin-top: 24px;
      flex: 1;

      &__title {
        @include h4();
      }

      &__image {
        //position: absolute;
        //right: 16px;
        //bottom: 16px;
      }
    }

    .footer {
      margin-top: 16px;
      font-weight: 700;
      font-size: 18px;
      line-height: 22px;
      /* identical to box height */

      display: flex;
      align-items: center;

      /* Gray/Grey 700 */

      color: #4a5568;
    }
  }
}
</style>
