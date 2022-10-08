<script setup lang="ts">
import { ref, computed, defineProps, onMounted } from 'vue'
import { TaskPopup } from '@/components'
import { orangeButton, outlineWhiteButton } from '@/assets/EgalStyles/EButton'
import { OnClickOutside } from '@vueuse/components'
import { getRandomInt } from '@/helpers/mixins'
import { TaskImages } from '@/types/enums'
import { useDateFormat } from '@vueuse/core'
import { productTypeAPIConstants } from '@/helpers/apiConstantsDictionary'

interface GoodCardProps {
  name: string
  photo: string
  description: string
  features: Record<string, string>
  price: number
  type: string
}
const props = defineProps<GoodCardProps>()

const isOpened = ref(false)

const image = computed(() => {
  return `background-image: url(${props.photo})`
})

const infoList = [
  'диаметр купола 104 см, длина 83 см',
  'полиэстер, 170T; металл; дерево',
]
</script>

<template>
  <OnClickOutside @trigger="isOpened = false">
    <div class="task-card" :style="`${isOpened ? 'z-index: 1' : ''}`">
      <div
        class="card"
        :class="{ 'card--opened': isOpened }"
        @click="isOpened = !isOpened"
      >
        <div class="header">
          <div class="header__badge header__badge--category">
            {{ productTypeAPIConstants[type] }}
          </div>
          <!--          <div class="header__badge header__badge&#45;&#45;amount">2458 шт</div>-->
        </div>
        <div class="body" :style="image">
          <div class="info">
            <p class="info__title">{{ name }}</p>
            <div class="info__price">{{ price }}₽</div>
          </div>
        </div>
      </div>

      <div class="under-card" v-if="isOpened">
        <div class="body">
          <div class="body__description">
            {{ description }}
          </div>

          <ul class="info-list">
            <li class="info-list__item" v-if="features.material">
              {{ features.material }}
            </li>
            <li class="info-list__item" v-if="features.package">
              {{ features.package }}
            </li>
            <li class="info-list__item" v-if="features.size">
              {{ features.size }}
            </li>
            <li class="info-list__item" v-if="features.weight">
              {{ features.weight }}
            </li>
          </ul>
        </div>

        <div class="footer">
          <EButton
            class="footer__button footer__button--buy"
            :style-config="orangeButton"
          >
            Взять себе
          </EButton>
          <EButton
            class="footer__button footer__button--give"
            :style-config="outlineWhiteButton"
          >
            Подарить
          </EButton>
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
    cursor: pointer;
    position: relative;
    @include card();
    display: flex;
    flex-direction: column;
    min-width: 320px;
    min-height: 255px;
    padding: 16px;
    background: $base-white;

    &--opened {
      z-index: 1;
    }

    .header {
      display: flex;
      gap: 16px;

      &__badge {
        @include badge();

        &--category {
          border: 0.5px solid $pressed-secondary-vtb;
          background-color: $pressed-secondary-vtb;
          color: $base-white;
        }

        &--amount {
          border: 0.5px solid $gray-500;
          background-color: $gray-500;
          color: $base-white;
        }
      }
    }

    .body {
      display: flex;
      flex: 1;
      //background: url('@/assets/img/good.png');
      background-position: center;
      background-repeat: no-repeat;
      background-size: contain;

      .info {
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin-top: auto;

        &__title {
          @include h4();
        }

        &__price {
          @include badge();
          border: 0.5px solid $default-accent-vtb;
          background-color: $default-accent-vtb;
          font-weight: $h4-font-style;
          font-size: $h4-font-size;
          color: $base-white;
        }
      }
    }
  }

  .under-card {
    @include card();
    display: flex;
    flex-direction: column;
    position: absolute;
    min-width: 320px;
    transform: translateY(-50px);
    padding: 74px 16px 16px 16px;
    background: $radiant-gradient-2-vtb;
    box-shadow: $shadow-lg;
    z-index: 0;

    .body {
      margin-top: 16px;

      &__description {
        @include p5();
        color: $base-white;
      }

      .info-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 16px;

        &__item {
          @include p5();
          color: $base-white;

          &::before {
            display: inline-block;
            content: '';
            width: 8px;
            height: 8px;
            background-color: $base-white;
            border-radius: 1px;
            margin-right: 8px;
          }
        }
      }
    }

    .footer {
      display: flex;
      margin-top: 92px;
      gap: 16px;
      align-items: flex-end;
      justify-content: center;

      &__button {
        &--buy {
          padding: 11.5px 32px;
        }
        &--give {
          padding-top: 11.5px;
          padding-bottom: 11.5px;
        }
      }
    }
  }
}
</style>
