<script setup lang="ts">
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { inputStyleConfig } from '@/assets/EgalStyles/EInput'
import { primaryButton, outlineButton } from '@/assets/EgalStyles/EButton'

const mock = [
  {
    name: 'Иванов Сергей',
    email: 'ivanovsergey@mail.ru',
    role: 'Начальник отдела тестирования департамента разработки ПО ВТБ',
    level: 12,
    nft_amount: 12,
  },
  {
    name: 'Иванов Сергей',
    email: 'ivanovsergey@mail.ru',
    role: 'Начальник отдела тестирования департамента разработки ПО ВТБ',
    level: 12,
    nft_amount: 12,
  },
  {
    name: 'Иванов Сергей',
    email: 'ivanovsergey@mail.ru',
    role: 'Начальник отдела тестирования департамента разработки ПО ВТБ',
    level: 12,
    nft_amount: 12,
  },
]
</script>

<template>
  <div class="leader-board">
    <div class="header">
      <div class="statistic">
        <div class="card">
          <span class="card__value">12 574</span>
          <span class="card__label">Выполненных задач</span>
        </div>
        <div class="card">
          <span class="card__value">1250</span>
          <span class="card__label">Участников</span>
        </div>
        <div class="card">
          <span class="card__value">146</span>
          <span class="card__label">NFT</span>
        </div>
      </div>
      <EInput
        class="search"
        :data="{
          ...inputDataConfig,
          placeholder: 'Поиск участников и команд...',
          iconLeft: 'search',
          modelValue: '',
        }"
        :style-config="inputStyleConfig"
      />
    </div>

    <div class="body">
      <div class="titles">
        <p class="titles__title">Лидеры месяца</p>
        <p class="titles__title">Команды месяца</p>
      </div>
      <ul class="leaders">
        <li class="leader-item" v-for="(user, index) in mock" :key="index">
          <div class="leader-side">
            <span class="leader-side__rating">{{ index + 1 }}</span>
            <img
              class="leader-side__astronaut"
              :src="require('@/assets/img/astronaut.svg')"
              alt="Astronaut"
            />
          </div>
          <div class="leader-body">
            <div class="user-info">
              <p class="user-info__title">{{ user.name }}</p>
              <div class="badge-list">
                <div class="badge-list__badge">{{ user.email }}</div>
                <div class="badge-list__badge">{{ user.role }}</div>
                <div class="badge-list__badge">{{ user.level }} уровень</div>
                <div class="badge-list__badge">{{ user.nft_amount }} NFT</div>
              </div>
            </div>
            <div class="controls">
              <EButton class="controls__button" :style-config="primaryButton">
                Перевести монеты
              </EButton>
              <EButton class="controls__button" :style-config="outlineButton">
                Написать
              </EButton>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.leader-board {
  .header {
    display: flex;
    align-items: flex-start;

    .statistic {
      display: flex;
      gap: 21px;

      .card {
        @include card();
        display: flex;
        align-items: center;
        padding: 24px;

        &__value {
          @include h2();
        }

        &__label {
          @include h4();
        }
      }
    }

    .search {
      margin-left: auto;
      margin-right: 26px;
    }
  }

  .body {
    margin-top: 92px;

    .titles {
      display: flex;
      gap: 85px;

      &__title {
        @include h1();
      }
    }

    .leaders {
      display: flex;
      flex-direction: column;
      gap: 48px;
      margin-top: 55px;

      .leader-item {
        @include card();
        position: relative;
        padding: 24px 26px 24px 28px;

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
      }
    }
  }
}
</style>
