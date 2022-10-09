<script setup lang="ts">
import { BadgeToggle, GoodCard, ModalWindow } from '@/components'
import { GoodCategories } from '@/types/enums'
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { inputStyleConfigWhiteOutline } from '@/assets/EgalStyles/EInput'
import { orangeButton } from '@/assets/EgalStyles/EButton'
import { ref, onMounted } from 'vue'
import { useProductStore } from '@/store/productStore'
import { useOrderStore } from '@/store/orderStore'

const productStore = useProductStore()
const orderStore = useOrderStore()

const selectedCategory = ref<GoodCategories>()

const isModalOpen = ref(false)
const whoseGift = ref('')
const closeModal = () => {
  whoseGift.value = ''
  isModalOpen.value = false
}

onMounted(() => {
  productStore.getProducts()
})

const createOrder = (productId: string) => {
  orderStore.createOrder(productId)
}
</script>

<template>
  <div class="goods">
    <div class="filters">
      <div class="badge-list">
        <p class="badge-list__title">Категория товара</p>
        <div class="badge-list__list">
          <BadgeToggle
            :active="category === selectedCategory"
            :key="category"
            v-for="category in GoodCategories"
            @click="selectedCategory = category"
          >
            {{ category }}
          </BadgeToggle>
        </div>
      </div>
      <EInput
        class="filter__search"
        :data="{
          ...inputDataConfig,
          placeholder: 'Поиск',
          iconLeft: 'search',
          modelValue: '',
        }"
      />
    </div>

    <div class="test">
      <div class="goods-list">
        <GoodCard
          class="goods-list__task"
          :name="product.name"
          :photo="product.photo"
          :description="product.description"
          :features="product.features"
          :price="product.price"
          :type="product.type"
          :key="product.id"
          @create-order="createOrder(product.id)"
          @send-gift="isModalOpen = true"
          v-for="product in productStore.products"
        />
      </div>
    </div>

    <ModalWindow
      class="modal modal--send-gift"
      :show="isModalOpen"
      @click.stop
      @close="closeModal"
    >
      <template #header>
        <span class="title">Отправить подарок</span>
      </template>
      <template #body>
        <div class="modal-body">
          <EInput
            class="modal-body__input"
            :data="{
              ...inputDataConfig,
              label: 'Кому подарим?',
              modelValue: whoseGift,
            }"
            :style-config="inputStyleConfigWhiteOutline"
            v-model="whoseGift"
          />
          <EButton class="modal-body__submit" :style-config="orangeButton">
            Подарить
          </EButton>
        </div>
      </template>
    </ModalWindow>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';
@import '@/assets/style/mixins.scss';

.goods {
  .filters {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    .badge-list {
      &__title {
        @include h5();
      }

      &__list {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 16px;
      }
    }

    &__search {
    }
  }

  .direction-filter {
    margin-top: 24px;
  }

  .goods-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(344px, 1fr));
    grid-column-gap: 24px;
    grid-row-gap: 32px;
    margin-top: 64px;
  }

  .modal {
    :deep(.modal-container) {
      @include modalBlue();
    }

    &--send-gift {
      .title {
        @include h3();
        color: $base-white;
      }

      .modal-body {
        margin-top: 32px;

        &__submit {
          margin-top: 32px;
        }
      }
    }
  }
}
</style>
