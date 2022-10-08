<script setup lang="ts">
import { ref, computed, defineProps } from 'vue'
import { ThumbUpSVG, ThumbDownSVG } from '@/components/SvgIcons'
import { TaskPopup } from '@/components'
import { outlineButton } from '@/assets/EgalStyles/EButton'
import { OnClickOutside } from '@vueuse/components'
import { getRandomInt } from '@/helpers/mixins'
import { TaskImages } from '@/types/enums'
import { useDateFormat } from '@vueuse/core'
import {
  taskTypeAPIConstants,
  taskDirectionsAPIConstants,
} from '@/helpers/apiConstantsDictionary'

interface TaskCardProps {
  name: string
  description: string
  author_id: string
  begin_at: string
  end_at: string
  category: string
  type: string
  reward: number
  author_email: string
  like_number: number
  dislike_number: number
}
const props = defineProps<TaskCardProps>()

const isOpened = ref(false)
const isPopupShowing = ref(false)

const taskImage = computed(() => {
  const imageName = Object.values(TaskImages)[getRandomInt(0, 4)]
  const imageFullName = isOpened.value
    ? `${imageName}-fill.png`
    : `${imageName}-line.svg`

  return require(`@/assets/img/${imageFullName}`)
})

const formattedDate = computed(() => {
  return useDateFormat(props.end_at, 'DD.MM.YYYY').value
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
          <div class="header__badge">{{ reward }}₽</div>
          <div class="header__badge">до {{ formattedDate }}</div>
        </div>
        <div class="body">
          <p class="body__title">{{ name }}</p>
          <img class="body__image" :src="taskImage" alt="Task image" />
        </div>
        <div class="footer">
          <div class="voices">
            <div class="positive-voices">
              <span class="positive-voices__amount">{{ like_number }}</span>
              <button class="positive-voices__button">
                <ThumbUpSVG :fill="isOpened ? '#ffffff' : '#66cb9f'" />
              </button>
            </div>
            <div class="negative-voices">
              <span class="negative-voices__amount">{{ dislike_number }}</span>
              <button class="negative-voices__button">
                <ThumbDownSVG :fill="isOpened ? '#ffffff' : '#f16063'" />
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="under-card" v-if="isOpened">
        <div class="header">
          <div class="task-directions">
            <div class="task-directions__badge">
              {{ taskDirectionsAPIConstants[category] }}
            </div>
            <div class="task-directions__badge">
              {{ taskTypeAPIConstants[type] }}
            </div>
          </div>
        </div>

        <div class="body">
          <div class="body__description">
            {{ description }}
          </div>

          <button class="body__more" @click="isPopupShowing = true">
            Подробнее о задаче...
          </button>
        </div>

        <div class="footer">
          <EButton class="footer__button" :style-config="outlineButton">
            Принять вызов
          </EButton>
          <router-link class="footer__link" to="#">Автор</router-link>
        </div>
      </div>
    </div>

    <TaskPopup
      :name="name"
      :description="description"
      :reward="reward"
      :begin_at="begin_at"
      :end_at="end_at"
      :author_id="author_id"
      :category="category"
      :type="type"
      :author_email="author_email"
      :like_number="like_number"
      :dislike_number="dislike_number"
      @close="isPopupShowing = false"
      v-if="isPopupShowing"
    />
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

    .header {
      .task-directions {
        display: flex;
        gap: 8px;

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

    .body {
      margin-top: 16px;

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
