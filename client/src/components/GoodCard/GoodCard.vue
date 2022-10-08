<script setup lang="ts">
import { ref, defineProps, defineEmits } from 'vue'
import { orangeButton, outlineWhiteButton } from '@/assets/EgalStyles/EButton'
import { OnClickOutside } from '@vueuse/components'
import { productTypeAPIConstants } from '@/helpers/apiConstantsDictionary'

interface GoodCardProps {
  name: string
  photo: string
  description: string
  features: Record<string, string>
  price: number
  type: string
}
defineProps<GoodCardProps>()

interface GoodCardEmits {
  (e: 'send-gift'): void
}
const emits = defineEmits<GoodCardEmits>()

const isOpened = ref(false)
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
        <div class="body">
          <div
            class="product-photo"
            :style="{ backgroundImage: `url(${photo})` }"
          ></div>

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
            @click="emits('send-gift')"
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
    box-shadow: $shadow-default;
    transition: 0.1s ease-in-out !important;

    &:hover {
      box-shadow: $shadow-2xl;
    }

    &--opened {
      box-shadow: $shadow-2xl;
      z-index: 1;
    }

    .header {
      background-color: white;
      padding-bottom: 10px;
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
      flex-direction: column;
      flex: 1;

      .product-photo {
        flex: 1;
        min-width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
      }

      .info {
        background-color: white;
        padding-top: 10px;
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
