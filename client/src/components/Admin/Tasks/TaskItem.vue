<script setup lang="ts">
import { defineEmits, PropType, defineProps, ref } from 'vue'
import { ITask } from '@/types/department/interfaces'
import ThumbDownSVG from '@/components/SvgIcons/ThumbDownSVG.vue'
import ThumbUpSVG from '@/components/SvgIcons/ThumbUpSVG.vue'
import EDropdown from '@/components/Egal/Dropdown/EDropdown.vue'
import CheckSVG from '@/components/SvgIcons/CheckSVG.vue'
import CloseSVG from '@/components/SvgIcons/CloseSVG.vue'

const emit = defineEmits(['edit', 'delete'])
const props = defineProps({
  item: { type: Object as PropType<ITask> },
})

const dropdownOpen = ref(false)
const openDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value
}
// заглушка данных с БД пользователей, которые прняли/не приняли задание
const userOptions = [
  {
    name: 'Иванов И.И.',
    uuid: '5463',
    accept: false,
  },
  {
    name: 'Константинопольский К.И.',
    uuid: '5',
    accept: false,
  },
  {
    name: 'Петров И.И.',
    uuid: '784',
    accept: false,
  },
]
</script>

<template>
  <div class="task card">
    <div class="header">
      <div class="badges">
        <div class="header__badge">${{ item.reward }}</div>
        <div class="header__badge">до {{ item.end_at }}</div>
      </div>

      <div class="voices">
        <div class="positive-voices">
          <span class="positive-voices__amount">245</span>
          <button class="positive-voices__button">
            <ThumbUpSVG :fill="'#66cb9f'" />
          </button>
        </div>
        <div class="negative-voices">
          <span class="negative-voices__amount">15</span>
          <button class="negative-voices__button">
            <ThumbDownSVG :fill="'#f16063'" />
          </button>
        </div>
      </div>
    </div>
    <div class="body">
      <p class="body__title">Заголовок задачи</p>
      <p class="body__description">{{ item.description }}</p>
      <router-link class="link" to="#"
        >Автор: {{ item.validator_id }}</router-link
      >
    </div>
    <div class="footer"></div>

    <div class="card__actions">
      <div class="card__buttons">
        <EButton @click="emit('edit')">Редактировать</EButton>

        <EButton @click="emit('delete')">Удалить</EButton>
      </div>
      <div class="card__select">
        <EButton @click="openDropdown">Подтвердить</EButton>
        <EDropdown v-if="dropdownOpen" :options="userOptions" :value="[]">
          <template #default>
            <div class="icons">
              <div class="icon-btn accept"><CheckSVG :fill="'#fff'" /></div>
              <div class="icon-btn cancel"><CloseSVG :fill="'#fff'" /></div>
            </div>
          </template>
        </EDropdown>
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
  min-width: 320px;
  min-height: 155px;
  padding: 16px;
  background: $base-white;

  .header {
    display: flex;
    justify-content: space-between;

    .badges {
      display: flex;
      gap: 16px;
    }
    &__badge {
      @include badge();
    }
  }

  .body {
    padding: 15px 0;
    &__title {
      @include h4();
      margin-bottom: 10px;
    }
    &__description {
      margin-bottom: 10px;
      line-height: 150%;
    }
  }

  .footer {
    margin-top: auto;
  }
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
  transition: 1s ease-in-out !important;

  .link {
    font-weight: 700;
    font-size: 12px;
    line-height: 12px;
    text-decoration-line: underline;
    color: $gray-500;
  }

  &__actions {
    display: flex;
    justify-content: space-between;
  }
  &__buttons {
    display: flex;
    gap: 15px;
    align-items: center;
  }
  &__select {
    .egal-button {
      margin-bottom: 8px;
    }
  }
}

.icons {
  display: flex;
  gap: 8px;

  justify-content: center;
  align-items: center;

  .icon-btn {
    padding: 4px;
    border-radius: 6px;
    opacity: 0.8;
    &:hover {
      opacity: 1;
    }
    &.accept {
      background-color: #66cb9f;
    }
    &.cancel {
      background-color: #ff5b5b;
    }

    svg {
      color: #fff;
      stroke: #fff;
      margin-bottom: 0;
    }
  }
}
</style>
