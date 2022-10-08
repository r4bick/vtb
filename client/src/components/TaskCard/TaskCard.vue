<script setup lang="ts">
import { reactive, ref, computed } from 'vue'
import { ThumbUpSVG, ThumbDownSVG } from '@/components/SvgIcons'
import { TaskPopup } from '@/components'
import { outlineButton } from '@/assets/EgalStyles/EButton'
import { OnClickOutside } from '@vueuse/components'
import { getRandomInt } from '@/helpers/mixins'

import { TaskDirections, TaskImages } from '@/types/enums'

const isOpened = ref(false)
const isPopupShowing = ref(false)

const taskDirections = reactive<TaskDirections[]>([
  TaskDirections.Learning,
  TaskDirections.Community,
])

const taskImage = computed(() => {
  const imageName = Object.values(TaskImages)[getRandomInt(0, 4)]
  const imageFullName = isOpened.value
    ? `${imageName}-fill.png`
    : `${imageName}-line.svg`

  return require(`@/assets/img/${imageFullName}`)
})
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
          <div class="header__badge">$2574</div>
          <div class="header__badge">до 15.08.2022</div>
        </div>
        <div class="body">
          <p class="body__title">Заголовок задачи</p>
          <img class="body__image" :src="taskImage" alt="Task image" />
        </div>
        <div class="footer">
          <div class="voices">
            <div class="positive-voices">
              <span class="positive-voices__amount">245</span>
              <button class="positive-voices__button">
                <ThumbUpSVG :fill="isOpened ? '#ffffff' : '#66cb9f'" />
              </button>
            </div>
            <div class="negative-voices">
              <span class="negative-voices__amount">15</span>
              <button class="negative-voices__button">
                <ThumbDownSVG :fill="isOpened ? '#ffffff' : '#f16063'" />
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="under-card" v-if="isOpened">
        <div class="body">
          <div class="body__description">
            NFT Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру
            сгенерировать несколько абзацев более менее осмысленного текста рыбы
            на русском языке, а начинающему оратору отточить навык публичных
            выступлений в домашних условиях. При создании генератора мы
            использовали небезизвестный универсальный код речей.
          </div>

          <button class="body__more" @click="isPopupShowing = true">
            Подробнее о задаче...
          </button>

          <div class="task-directions">
            <div
              class="task-directions__badge"
              v-for="direction in taskDirections"
              :key="direction"
            >
              {{ direction }}
            </div>
          </div>
        </div>

        <div class="footer">
          <EButton class="" :style-config="outlineButton">Выполнить</EButton>
          <router-link class="footer__link" to="#">Автор: 234567</router-link>
        </div>
      </div>
    </div>

    <TaskPopup v-if="isPopupShowing" @close="isPopupShowing = false" />
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

    .header {
      display: flex;
      gap: 16px;

      &__badge {
        @include badge();
      }
    }

    .body {
      margin-top: 24px;
      flex: 1;

      &__title {
        @include h4();
      }

      &__image {
        position: absolute;
        right: 16px;
        bottom: 16px;
      }
    }

    .footer {
      margin-top: 10px;

      .voices {
        display: flex;
        gap: 10px;

        .positive-voices__amount,
        .negative-voices__amount {
          @include h7();
          cursor: default;
        }

        .positive-voices__button,
        .negative-voices__button {
          cursor: pointer;
          border: none;
          padding: 0;
          background-color: unset;
        }

        .positive-voices,
        .negative-voices {
          display: flex;
          align-items: center;
          gap: 4px;
        }

        .positive-voices {
          &__amount {
            color: $success;
          }
        }

        .negative-voices {
          &__button {
            display: flex;
          }

          &__amount {
            color: $danger;
          }
        }
      }
    }

    transition: 1s ease-in-out !important;

    &--opened {
      background: $radiant-gradient-vtb;
      z-index: 1;

      .header {
        &__badge {
          border-color: $base-white;
          color: $base-white;
        }
      }

      .body {
        &__title {
          color: $base-white;
        }
      }

      .voices {
        .negative-voices__amount,
        .positive-voices__amount {
          color: $base-white !important;
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
    z-index: 0;

    .body {
      &__description {
        @include p5();
      }

      &__more {
        @include h7();
        cursor: pointer;
        background: unset;
        border: none;
        color: $default-accent-vtb;
        padding: 0;
        margin-top: 17px;
      }

      .task-directions {
        display: flex;
        gap: 8px;
        margin-top: 16px;

        &__badge {
          @include badge();
          color: $gray-700;
          background-color: $gray-300;
          font-weight: 700;
          font-size: 10px;
          line-height: 12px;
        }
      }
    }

    .footer {
      display: flex;
      justify-content: space-between;
      margin-top: 35px;
      align-items: flex-end;

      &__link {
        font-weight: 700;
        font-size: 10px;
        line-height: 12px;
        text-decoration-line: underline;
        color: $gray-500;
      }
    }
  }
}
</style>
