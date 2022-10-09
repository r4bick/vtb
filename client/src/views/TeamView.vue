<script setup lang="ts">
import { useTaskStore } from '@/store/taskStore'
import { onMounted, ref } from 'vue'
import TaskCard from '@/components/TaskCard/TaskCard'
import { orangeButton, outlineButton } from '@/assets/EgalStyles/EButton'
import NftCard from '@/components/NFT/NftCard.vue'
import { useUserStore } from '@/store/userStore'
import { useCookies } from 'vue3-cookies'
import { useEthereum } from '@/composables/useEthereum'
import BadgesCard from '@/components/BadgesCard/BadgesCard.vue'
import PartyCard from '@/components/Team/PartyCard.vue'

const taskStore = useTaskStore()
const userStore = useUserStore()
const { cookies } = useCookies()
const { coinBalance } = useEthereum()

const name = ref('')
const currentUser = ref()

onMounted(async () => {
  if (Object.keys(userStore.user).length) {
    currentUser.value = userStore.user
  } else {
    const uid = cookies.get('id')
    currentUser.value = await userStore.getUserById(uid)
  }

  await taskStore.getTasks()
  name.value =
    currentUser.value.account.first_name +
    ' ' +
    currentUser.value.account.last_name
})

const nfts = [
  { title: '200 релизов', image: '1' },
  { title: 'Поднял продакшн', image: '2' },
  { title: 'Выполнил 100 задач', image: '3' },
]

const config = {
  type: 'horizontal_bar',

  data: {
    datasets: [
      {
        label: 'Митап',
        backgroundColor: '#0066FF',
        data: [40],
      },
      {
        label: 'Комьюнити',
        backgroundColor: '#76ACFB',
        data: [51],
      },
      {
        label: 'Менторинг',
        backgroundColor: '#A0AEC0',
        data: [4],
      },
    ],
  },
  options: {
    emptyColor: '#e2e8f0',
    fontColor: '#2D3748',
    secondFontColor: '#A0AEC0',
    titleFontSize: '14px',
    labelsFontSize: '12px',
    fontWeight: 'bold',
    secondFontWeight: 'normal',
    thickness: 7,
    background: '#ffffff',
  },
}
</script>

<template>
  <div class="home">
    <div class="profile">
      <div class="card--image card">
        <img class="rounds" src="@/assets/img/orbit.svg" alt="" />
        <img class="mascot" src="@/assets/img/clan.svg" alt="" />
      </div>

      <div class="info">
        <div class="info--personal">
          <BadgesCard
            name="Клан захватчиков"
            :badges="[
              'ivanovsergey@mail.ru',
              'Лидер - Иванов Сергей',
              'Отдел тестирования департамента разработки ПО ВТБ',
            ]"
          />

          <div class="row">
            <div class="card card--balance">
              <span class="text--regular">Баланс</span>
              <span class="text--big"
                >{{ coinBalance || '0.00' }} &#8381;
              </span>
            </div>
            <div class="card card--rating">
              <span class="text--regular">Рейтинг</span>
              <span class="text--big">4 место</span>
            </div>
            <div class="card card--nft-amount">
              <span class="text--big">5</span>
              <span class="text--regular">NFT</span>
            </div>
          </div>
          <div class="row row--reverse">
            <div class="card card--level">
              <span class="text--regular">Уровень</span>
              <span class="text--big">16</span>
            </div>
            <div class="card card--completed">
              <span class="text--big">1257</span>
              <span class="text--regular">Выполненных задач</span>
            </div>
            <div class="card card--participants">
              <span class="text--big">12</span>
              <span class="text--regular">Участников</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="title-list">Участники</div>
    <div class="party">
      <PartyCard />
    </div>

    <div class="title-list">Задачи</div>
    <div class="tasks">
      <TaskCard
        class="tasks-list__task"
        :name="task.name"
        :description="task.description"
        :end_at="task.end_at"
        :reward="task.reward"
        :author_email="task.author.email"
        :category="task.category"
        :type="task.type"
        :like_number="task.like_number"
        :dislike_number="task.dislike_number"
        :key="task.id"
        v-for="task in taskStore.tasks"
      />
    </div>
    <div class="title-list">NFT</div>
    <div class="nft">
      <NftCard
        v-for="nft in nfts"
        :key="nft.title"
        :image="nft.image"
        :title="nft.title"
      />
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.title-list {
  font-weight: 700;
  font-size: 36px;
  line-height: 44px;

  display: flex;
  align-items: center;
  text-align: center;

  color: $gray-700;
  margin-bottom: 24px;
}
.profile {
  display: flex;
  gap: 24px;
  margin-bottom: 66px;

  .info {
    display: flex;
    flex-direction: column;

    gap: 24px;
    &--personal {
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      gap: 24px;
    }
  }
  .row {
    display: grid;
    grid-template-columns: 2.5fr 2fr 1fr;
    gap: 24px;
    .card {
      padding: 32px 20px;
    }
    &--reverse {
      grid-template-columns: 1fr 2.5fr 2fr;
      .card {
        padding: 24px;
      }
    }
    .card {
      display: flex;
      flex-direction: row;
      gap: 16px;
      color: $gray-700;
      font-weight: 700;
      align-items: center;

      &--nft-amount {
        gap: 10px;
      }
      &--completed {
        gap: 24px;
      }

      .text {
        &--big {
          font-size: 32px;
          line-height: 39px;
        }
        &--regular {
          font-size: 18px;
          line-height: 18px;
        }
      }
    }
  }
}
.tasks {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
  margin-bottom: 40px;
  :deep(.task-card) {
    .card {
      min-width: 285px;
    }
  }
}
.nft {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

// card
.card {
  position: relative;
  @include card();
  display: flex;
  flex-direction: column;
  padding: 24px;
  background: $base-white;

  &--clan {
    display: flex;
    flex-direction: column;
    min-width: 398px;
    min-height: 100px;
    flex-grow: 1;
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

  &--image {
    width: 502px;
    height: 372px;
    position: relative;
    flex-shrink: 0;
    img {
      position: absolute;
    }
    .rounds {
      top: -4%;
      left: -17%;
    }
    .mascot {
      top: 20px;
      left: 7%;
    }
  }
  &--balance {
    .header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 22px;
      font-weight: 700;
      font-size: 18px;
      line-height: 22px;
      align-items: center;
      text-align: center;
      color: $gray-700;

      .balance {
        font-weight: 700;
        font-size: 32px;
        line-height: 39px;
      }
    }
    .buttons {
      display: flex;
      gap: 16px;
    }
  }

  &--skills {
    .header {
      font-weight: 700;
      font-size: 18px;
      line-height: 22px;
      color: $gray-700;
    }
  }
}

.chart-wrapper {
  padding: 0 !important;
  border: none !important;
  box-shadow: none !important;
}

@media (max-width: 1240px) {
  .rounds {
    display: none;
  }
}
</style>
