<script setup lang="ts">
import { computed, onMounted, reactive, defineEmits, defineProps } from 'vue'
import { XIconSVG, ThumbUpSVG, ThumbDownSVG } from '@/components/SvgIcons'
import {
  TaskDirections,
  TaskImages,
  TaskStatuses,
  TaskTypes,
} from '@/types/enums'
import {
  orangeButton,
  primaryButton,
  outlineLightGrayButton,
} from '@/assets/EgalStyles/EButton'
import { getRandomInt } from '@/helpers/mixins'
import { OnClickOutside } from '@vueuse/components'
import { useDateFormat } from '@vueuse/core'
import {
  taskTypeAPIConstants,
  taskDirectionsAPIConstants,
} from '@/helpers/apiConstantsDictionary'

interface TaskPopupProps {
  name: string
  description: string
  author_id: string
  begin_at: string
  end_at: string
  category: string
  reward: number
  author_email: string
  type: string
  like_number: number
  dislike_number: number
  status: TaskStatuses
}
const props = defineProps<TaskPopupProps>()

interface TaskPopupEmits {
  (e: 'close'): void
}
const emits = defineEmits<TaskPopupEmits>()

const objectImages: string[] = reactive<TaskImages[]>([])

const getUniqueOrbitObjects = (): string => {
  const imageNames = Object.values(TaskImages)
  const image = imageNames[getRandomInt(0, 5)]

  if (objectImages.includes(image)) {
    return getUniqueOrbitObjects()
  } else {
    return image
  }
}

const orbitObjectImages = computed(() => {
  return objectImages.map((imageName) =>
    require(`@/assets/img/${imageName}-fill.png`),
  )
})

onMounted(() => {
  for (let i = 0; i < 3; i++) {
    objectImages.push(getUniqueOrbitObjects())
  }
})

const taskDeadline = computed(() => {
  const begin = useDateFormat(props.begin_at, 'DD.MM.YYYY').value
  const end = useDateFormat(props.end_at, 'DD.MM.YYYY').value
  return `${begin}-${end}`
})
</script>

<template>
  <OnClickOutside @trigger="emits('close')">
    <div class="task-popup-wrapper">
      <div
        class="task-popup"
        :class="{
          'task-popup--in-processing':
            status === TaskStatuses.InProcess || status === TaskStatuses.Done,
        }"
      >
        <div class="header">
          <div class="header__badge">{{ reward }}₽</div>
          <div class="header__badge">
            {{ taskDirectionsAPIConstants[category] }}
          </div>
          <div class="header__badge">{{ taskTypeAPIConstants[type] }}</div>
          <div class="header__badge">{{ taskDeadline }}</div>
          <button class="header__close" @click="emits('close')">
            <XIconSVG />
          </button>
        </div>

        <div class="body">
          <div class="main-info">
            <h1 class="body__title">
              {{ name }}
            </h1>
            <div class="body__description">
              {{ description }}
            </div>
            <div class="badges">
              <div class="badges__badge">
                <span>Автор:</span>
                <span>{{ author_email }}</span>
              </div>
              <div class="badges__badge">
                <span>Срок задачи:</span>
                <span>{{ taskDeadline }}</span>
              </div>
            </div>

            <div class="accept">
              <span class="accept__price">{{ reward }} RU</span>

              <div
                class="controls"
                v-if="
                  status === TaskStatuses.InProcess ||
                  status === TaskStatuses.Done
                "
              >
                <EButton
                  class="controls__button"
                  :data="{ size: 'lg', disabled: status === TaskStatuses.Done }"
                  :style-config="primaryButton"
                >
                  {{
                    status === TaskStatuses.Done
                      ? 'Подтверждение отправлено'
                      : 'Подтвердить выполнение'
                  }}
                </EButton>

                <EButton
                  class="controls__button"
                  :data="{ size: 'lg' }"
                  :style-config="outlineLightGrayButton"
                >
                  <XIconSVG class="controls__button-icon" />
                  Отменить
                </EButton>
              </div>
              <div class="controls" v-else>
                <EButton
                  class="controls__button"
                  :data="{ size: 'lg' }"
                  :style-config="orangeButton"
                >
                  Принять вызов
                </EButton>
              </div>
            </div>
          </div>
        </div>
        <div class="footer">
          <div class="voices">
            <div class="positive-voices">
              <span class="positive-voices__amount">{{ like_number }}</span>
              <button class="positive-voices__button">
                <ThumbUpSVG fill="#ffffff" />
              </button>
            </div>
            <div class="negative-voices">
              <span class="negative-voices__amount">{{ dislike_number }}</span>
              <button class="negative-voices__button">
                <ThumbDownSVG fill="#ffffff" />
              </button>
            </div>
          </div>
        </div>

        <div class="orbit-collage-wrapper">
          <div class="orbit-collage">
            <img
              class="orbit-collage__orbit"
              :src="require('@/assets/img/orbit-collage.png')"
              alt="orbit"
            />
            <img
              class="orbit-collage__object-sm"
              :src="orbitObjectImages[0]"
              alt="orbit object 1"
            />
            <img
              class="orbit-collage__object-md"
              :src="orbitObjectImages[1]"
              alt="orbit object 2"
            />
            <img
              class="orbit-collage__object-lg"
              :src="orbitObjectImages[2]"
              alt="orbit object 3"
            />
          </div>
        </div>
      </div>
    </div>
  </OnClickOutside>
</template>

<style scoped lang="scss">
@import '@/assets/style/mixins.scss';
@import '@/assets/style/variables.scss';

.task-popup-wrapper {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: calc(100% - 100px); // сумма боковых паддингов лэйаута
  z-index: 2;

  .task-popup {
    @include card();
    box-sizing: border-box;
    box-shadow: none;
    position: relative;
    background: $radiant-gradient-2-vtb;
    padding: 32px 32px 43px 32px;

    .header {
      display: flex;
      gap: 16px;

      &__badge {
        @include badge();
        border-color: $base-white;
        color: $base-white;
      }

      &__close {
        cursor: pointer;
        background: none;
        border: none;
        margin-left: auto;
      }
    }

    .body {
      display: flex;
      flex-direction: column;
      margin-top: 32px;

      &__title {
        @include h1();
        color: $base-white;
      }
      &__description {
        white-space: pre-wrap;
        position: relative;
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 150%;
        color: $base-white;
        margin-top: 24px;
        padding-right: 78px;
        z-index: 1;
      }

      .badges {
        display: flex;
        gap: 16px;
        margin-top: 16px;

        &__badge {
          display: flex;
          gap: 16px;
          @include badge();
          border-radius: $all-sides-small;
          background-color: $pressed-accent-vtb;
          border: none;

          @include h6();
          color: $base-white;
        }
      }

      .accept {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-top: 32px;

        &__price {
          @include h2();
          color: $base-white;
        }

        .controls {
          display: flex;
          gap: 16px;

          &__button {
            padding: 14.5px 46px;
          }
        }
      }
    }

    .footer {
      margin-top: 56px;

      .voices {
        display: flex;
        gap: 10px;

        .positive-voices__amount,
        .negative-voices__amount {
          @include h7();
          color: $base-white;
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

        .negative-voices {
          &__button {
            display: flex;
          }
        }
      }
    }

    .orbit-collage-wrapper {
      position: absolute;
      bottom: 40px;
      right: 32px;

      .orbit-collage {
        width: 324px;
        height: 216px;
        position: relative;

        &__orbit,
        &__object-sm,
        &__object-md,
        &__object-lg {
          position: absolute;
        }

        &__orbit {
          right: 0;
          bottom: 0;
          width: 100%;
          height: 100%;
        }

        &__object-sm {
          left: 0;
          top: 50%;
          transform: translate(-30%, -30%) scale(0.6);
        }

        &__object-md {
          width: 83px;
          height: 83px;
          top: 0;
          left: 50%;
          transform: translateY(-30%) scale(0.9);
        }

        &__object-lg {
          width: 166px;
          height: 166px;
          bottom: 0;
          left: 50%;
          transform: translateY(10%) scale(1);
        }
      }
    }

    &--in-processing {
      background: $radiant-gradient-green-2-vtb;

      .body {
        .badges {
          &__badge {
            background-color: $default-cyan-vtb;
          }
        }

        .accept {
          .controls {
            &__button-icon {
              width: 10px;
              height: 10px;
              margin-right: 13px;
            }
          }
        }
      }
    }
  }
}
</style>
