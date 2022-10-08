<script setup lang="ts">
import { computed, onMounted, reactive, defineEmits } from 'vue'
import { XIconSVG, ThumbUpSVG, ThumbDownSVG } from '@/components/SvgIcons'
import { TaskDirections, TaskImages } from '@/types/enums'
import { orangeButton } from '@/assets/EgalStyles/EButton'
import { getRandomInt } from '@/helpers/mixins'
import { OnClickOutside } from '@vueuse/components'

interface TaskPopupEmits {
  (e: 'close'): void
}
const emits = defineEmits<TaskPopupEmits>()

const directions = [TaskDirections.Meetup, TaskDirections.Community]
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
</script>

<template>
  <OnClickOutside @trigger="emits('close')">
    <div class="task-popup-wrapper">
      <div class="task-popup">
        <div class="header">
          <div class="header__badge">$2574</div>
          <div
            class="header__badge"
            v-for="direction in directions"
            :key="direction"
          >
            {{ direction }}
          </div>
          <div class="header__badge">индивидуальная</div>
          <div class="header__badge">25.10.2022-30.11.2022</div>
          <button class="header__close" @click="emits('close')">
            <XIconSVG />
          </button>
        </div>

        <div class="body">
          <div class="main-info">
            <h1 class="body__title">
              Выступление с докладом на Heisenbug Conf 2022
            </h1>
            <div class="body__description">
              Heisenbug — крупнейшая в России конференция по тестированию
              программного обеспечения. Доклады и дискуссии для специалистов
              разных профилей: QA-инженеров, разработчиков, тимлидов, директоров
              по качеству. Конференция больше ориентирована на технологии, чем
              на процессы и методологии. Ее организатор — JUG Ru Group. Говорим
              о самом важном — практическом и хардкорном тестировании на
              реальных проектах Автоматизация тестирования; Инструменты и
              окружение для ручного и автоматизированного тестирования;
              Тестирование распределённых систем; Тестирование мобильных
              приложений; UX, Security; Нагрузочное тестирование,
              performance-тестирование, бенчмаркинг; AI в тестировании; Мы
              ориентированы на технологическую сторону тестирования, и, если вы
              в ней пока новичок, это лишний повод нас посетить. Никаких
              тест-кейсов, правил заведения багов и управления командами —
              только технологии, только хардкор! Ссылка на
              конференцию:https://heisenbug.ru/
            </div>
            <div class="badges">
              <div class="badges__badge">
                <span>Автор:</span>
                <span>234567</span>
              </div>
              <div class="badges__badge">
                <span>Срок задачи:</span>
                <span>25.10.2022-30.11.2022</span>
              </div>
            </div>

            <div class="accept">
              <span class="accept__price">2574 RU</span>
              <EButton
                class="accept__button"
                :data="{ size: 'lg' }"
                :style-config="orangeButton"
              >
                Принять вызов
              </EButton>
            </div>
          </div>
        </div>
        <div class="footer">
          <div class="voices">
            <div class="positive-voices">
              <span class="positive-voices__amount">245</span>
              <button class="positive-voices__button">
                <ThumbUpSVG fill="#ffffff" />
              </button>
            </div>
            <div class="negative-voices">
              <span class="negative-voices__amount">15</span>
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
              :src="require('@/assets/img/orbit.svg')"
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
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 150%;
        color: $base-white;
        margin-top: 24px;
        padding-right: 78px;
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

        &__button {
          padding: 14.5px 46px;
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
        }

        &__object-sm {
          //width: 60px;
          //height: 60px;
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
  }
}
</style>
