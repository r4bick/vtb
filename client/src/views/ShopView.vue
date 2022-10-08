<script setup lang="ts">
import { BadgeToggle, GoodCard } from '@/components'
import { GoodCategories } from '@/types/enums'
import { inputDataConfig } from '@/assets/EgalData/EInput'
import { ref, onMounted } from 'vue'
import { useProductStore } from '@/store/productStore'

const productStore = useProductStore()

const selectedCategory = ref<GoodCategories>()

onMounted(() => {
  productStore.getProducts()
})
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
        v-for="product in productStore.products"
      />
    </div>
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
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 24px;
    grid-row-gap: 32px;
    margin-top: 64px;
  }
}
</style>
