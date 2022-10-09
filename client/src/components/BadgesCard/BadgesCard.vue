<script setup lang="ts">
import { ref, computed, defineProps, onMounted } from 'vue'
import { TaskPopup } from '@/components'
import { orangeButton, outlineWhiteButton } from '@/assets/EgalStyles/EButton'
import { OnClickOutside } from '@vueuse/components'
import { getRandomInt } from '@/helpers/mixins'
import { TaskImages } from '@/types/enums'
import { useDateFormat } from '@vueuse/core'
import { productTypeAPIConstants } from '@/helpers/apiConstantsDictionary'

interface BadgesCardProps {
  name: string
  badges: string[]
}
const props = defineProps<BadgesCardProps>()
</script>

<template>
  <div class="card">
    <div class="header">
      {{ name }}
    </div>
    <div class="badges">
      <div class="badge" v-for="badge in badges" :key="badge">
        {{ badge }}
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.card {
  position: relative;
  @include card();
  display: flex;
  flex-direction: column;
  padding: 24px;
  background: $base-white;

  min-width: 398px;
  min-height: 100px;

  .header {
    font-weight: 700;
    font-size: 36px;
    line-height: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    text-align: center;
    margin-bottom: 28px;
    color: $gray-800;
  }

  .badges {
    display: flex;
    gap: 10px;

    .badge {
      padding: 4px 8px;
      border: 0.5px solid $gray-400;
      border-radius: 8px;
      font-weight: 700;
      font-size: 12px;
      line-height: 15px;
      display: flex;
      align-items: center;
      text-align: center;
      color: $gray-600;
    }
  }
}
</style>
