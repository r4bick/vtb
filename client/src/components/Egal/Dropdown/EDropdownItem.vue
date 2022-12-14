<template>
  <div
    class="dropdown-item"
    :class="[{ active: isActive(option) }, `dropdown-item--${size}`]"
    v-for="option in filteredOptions"
    :key="option"
    @click.stop="$emit('select', option)"
    @touchstart.prevent="$emit('select', option)"
  >
    <div class="start">
      <span>{{ option[shownKey] }}</span>
    </div>

    <div class="end">
      <slot name="end" />
      <span class="badge" v-if="option[shownBadgeKey]">{{
        option[shownBadgeKey]
      }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EDropdownItem',
  components: {},
  props: {
    styleConfig: {
      type: Object,
      // eslint-disable-next-line @typescript-eslint/no-empty-function
      default: () => {},
    },
    filteredOptions: {
      type: Array,
      default: () => [],
    },
    iconLeft: {
      type: String,
      default: '',
    },
    iconRight: {
      type: String,
      default: '',
    },
    shownKey: {
      type: String,
      default: 'name',
    },
    shownBadgeKey: {
      type: String,
      default: '',
    },
    value: {
      type: Object,
      // eslint-disable-next-line @typescript-eslint/no-empty-function
      default: () => {},
    },
    size: {
      type: String,
      default: 'md',
    },

    computedStyles: {
      type: Object,
      // eslint-disable-next-line @typescript-eslint/no-empty-function
      default: () => {},
    },
  },
  emits: ['select', ''],
  data() {
    return {}
  },
  computed: {},

  methods: {
    /**
     * Return true if option is selected
     * @param option
     */
    isActive(option) {
      if (Array.isArray(this.value)) {
        return (
          this.value.findIndex(
            (item) => item[this.shownKey] === option[this.shownKey],
          ) !== -1
        )
      }

      return this.value[this.shownKey] === option[this.shownKey]
    },
  },
  watch: {},
}
</script>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';

.dropdown-item {
  padding: 8px 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 15px;
  cursor: pointer;
  border-radius: 6px;
  transition: 0.2s all ease;
  color: var(--option-color);
  width: 100%;
  box-sizing: border-box;
  font-weight: var(--option-font-weight);
  margin-bottom: 4px;

  &:hover {
    background-color: rgba(226, 232, 240, 0.46);
  }

  &:active {
    background-color: var(--option-press-background-color);
  }

  .icon {
    color: var(--option-color);

    &--left {
      margin-right: 8px;
    }
  }

  .badge {
    margin-left: 8px;
    background-color: $gray-200;
    border-radius: 24px;
    padding: 0 6px;
    color: $gray-800;
    font-size: 12px;
    line-height: 15px;
    font-weight: 400;
  }

  &.active {
    background-color: var(--active-background-color);
    color: var(--active-option-color);

    .icon {
      color: var(--active-option-color);
    }

    &:hover {
      background-color: var(--active-hover-background-color);
    }

    &:active {
      background-color: var(--active-press-background-color);
    }
  }

  &--lg {
    font-size: 16px;
    margin-bottom: 6px;

    .icon {
      width: 20px;
      height: 20px;
    }
  }
  &--md {
    font-size: 14px;
    margin-bottom: 2px;

    .icon {
      width: 16px;
      height: 16px;
    }
  }
  &--sm {
    font-size: 12px;

    .icon {
      width: 14px;
      height: 14px;
    }
  }

  &--xs {
    font-size: 10px;

    .icon {
      width: 10px;
      height: 10px;
    }

    .badge {
      font-size: 12px;
      line-height: 12px;
    }
  }
}
</style>
