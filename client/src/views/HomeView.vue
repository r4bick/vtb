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
      <div class="info">
        <div class="info--personal">
          <BadgesCard
            :name="name"
            :badges="[
              currentUser?.email,
              `${currentUser?.account.level || 0} уровень`,
              `Клан захватчиков`,
            ]"
          />

          <div class="card card--balance">
            <div class="header">
              <span class="title">Баланс</span>
              <span class="balance">{{ coinBalance || '0.00' }} &#8381; </span>
            </div>
            <div class="buttons">
              <EButton :style-config="orangeButton">Перевести монеты</EButton>
              <EButton :style-config="outlineButton">Вывести</EButton>
            </div>
          </div>
        </div>
        <div class="card card--skills">
          <div class="header">Скиллы</div>
          <Chart :data="config" />
        </div>
      </div>
      <div class="card--image card">
        <img class="rounds" src="@/assets/img/orbit.svg" alt="" />
        <img class="spaceman" src="@/assets/img/Frock_3.svg" alt="" />
      </div>
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
        :status="task.status"
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
      gap: 24px;
    }
  }
  .image {
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

  &--person {
    display: flex;
    flex-direction: column;
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

  &--image {
    width: 528px;
    height: 372px;
    position: relative;
    img {
      position: absolute;
    }
    .rounds {
      top: -3px;
      left: -78px;
      //width: 125%;
    }
    .spaceman {
      top: 20px;
      left: 23%;
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
