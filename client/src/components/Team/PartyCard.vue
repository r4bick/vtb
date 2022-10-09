<script setup lang="ts">
import { computed, defineProps, onMounted } from 'vue'
import BadgesCard from '@/components/BadgesCard/BadgesCard.vue'
import { outlineButton } from '@/assets/EgalStyles/EButton'

// interface PartyCardProps {
// title: string
// image: string
// }
// const props = defineProps<PartyCardProps>()

// const taskImage = computed(() => {
//   return require(`@/assets/img/nftcard/${props.image}.png`)
// })
</script>

<template>
  <div class="wrapper">
    <div class="card">
      <img class="image" src="@/assets/img/Party.svg" alt="image" />
      <BadgesCard
        class="body"
        name="Иванов Сергей"
        :badges="[
          'ivanovsergey@mail.ru',
          ' Начальник отдела тестирования департамента разработки ПО ВТБ',
          '12 уровень',
        ]"
      />

      <div class="actions">
        <EButton>Перевести монеты</EButton>
        <EButton :style-config="outlineButton">Написать</EButton>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.wrapper {
  position: relative;

  .card {
    position: relative;
    @include card();
    display: flex;

    padding: 24px;
    background: $base-white;

    .header {
      display: flex;
      gap: 16px;
    }

    .image {
      width: 115px;
      margin-top: -70px;
    }
    .actions {
      display: flex;
      gap: 16px;
      align-items: center;
      margin-left: auto;
      margin-right: 42px;
    }
    .body {
      box-shadow: none;
      min-height: 0;
      padding: 0;
      margin-left: 20px;
    }
  }
}
</style>
