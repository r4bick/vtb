<template>
  <div
    class="dropdown"
    :class="`dropdown--${size} dropdown--${dropdownPosition}`"
    :style="getStyleVars"
  >
    <div class="dropdown-items">
      <div
        class="dropdown-item dropdown-item--empty"
        v-if="filteredOptions.length === 0"
      >
        {{ emptyDropdownText }}
      </div>

      <EDropdownItem
        v-else
        :value="value"
        :shown-key="shownKey"
        :size="size"
        :shown-badge-key="shownBadgeKey"
        :icon-right="iconRight"
        :icon-left="iconLeft"
        :filtered-options="filteredOptions"
        :computed-styles="getStyleVars"
        @select="(option) => $emit('select', option)"
      >
        <template #end>
          <slot />
        </template>
      </EDropdownItem>
    </div>
  </div>
</template>

<script>
import EDropdownItem from '@/components/Egal/Dropdown/EDropdownItem'
export default {
  name: 'EDropdown',
  components: {
    EDropdownItem,
  },
  props: {
    size: {
      type: String,
      default: 'md',
    },
    options: {
      type: Array,
      default: () => [],
    },
    searchable: {
      type: Boolean,
      default: false,
    },
    value: {
      type: [Object, Array],
      // eslint-disable-next-line @typescript-eslint/no-empty-function
      default: () => {},
    },
    shownKey: {
      type: String,
      default: 'name',
    },
    shownBadgeKey: {
      type: String,
      default: '',
    },
    grouped: {
      type: Boolean,
      default: false,
    },
    styleConfig: {
      type: Object,
      // eslint-disable-next-line @typescript-eslint/no-empty-function
      default: () => {},
    },
    inputSearchStyleConfig: {
      type: Object,
      // eslint-disable-next-line @typescript-eslint/no-empty-function
      default: () => {},
    },
    searchPlaceholder: {
      type: String,
      default: 'Search',
    },
    emptyDropdownText: {
      type: String,
      default: 'No results found',
    },
    dropdownPosition: {
      type: String,
      default: 'bottom',
    },
    showMoreButtonDisplay: {
      type: Boolean,
      default: false,
    },
    showMoreButtonText: {
      type: String,
      default: 'Show more...',
    },
    iconLeft: {
      type: String,
      default: '',
    },
    iconRight: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      filteredOptions: this.options,
    }
  },
  computed: {
    getStyleVars() {
      return {
        '--font-family': this.styleConfig?.fontFamily || 'Inter',
        '--option-color': this.styleConfig?.optionColor || '#2d3748',
        '--option-hover-background-color':
          this.styleConfig?.optionHoverBackgroundColor || '#E2E8F0',
        '--option-press-background-color':
          this.styleConfig?.optionPressBackgroundColor || '#cbd5e0',
        '--option-font-weight': this.styleConfig?.optionFontWeight || 400,
        '--active-background-color':
          this.styleConfig?.activeBackgroundColor || '#3385ff',
        '--active-option-color':
          this.styleConfig?.activeOptionColor || '#ffffff',
        '--active-hover-background-color':
          this.styleConfig?.activeHoverBackgroundColor || '#3385ff',
        '--active-press-background-color':
          this.styleConfig?.activePressBackgroundColor || '#005ce4',
        '--group-name-color': this.styleConfig?.groupNameColor || '#a0aec0',
        '--group-name-font-weight':
          this.styleConfig?.groupNameFontWeight || 700,
        '--background-color': this.styleConfig?.backgroundColor || '#ffffff',
        '--border-color': this.styleConfig?.borderColor || '#edf2f7',
        '--border-radius': this.styleConfig?.borderRadius || '6px',
        '--box-shadow':
          this.styleConfig?.boxShadow ||
          '0px 0px 1px rgba(12, 26, 75, 0.24), 0px 3px 8px -1px rgba(50, 50, 71, 0.05)',
      }
    },
  },
  methods: {
    /**
     * Filer options by search value
     * @param value
     */
    filterOptions(value) {
      if (!value) {
        this.filteredOptions = this.options
        return
      }
      this.filteredOptions = this.options.filter(
        (option) =>
          option[this.shownKey].toLowerCase().indexOf(value.toLowerCase()) !==
          -1,
      )
    },
  },
  watch: {
    options(newValue) {
      this.filteredOptions = newValue
    },
  },
}
</script>

<style scoped lang="scss">
@import '@/assets/style/variables.scss';

::-webkit-scrollbar {
  width: 4px;
  height: 4px;
}
::-webkit-scrollbar-track {
  background-color: $gray-100;
}

::-webkit-scrollbar-thumb {
  background-color: $gray-300;
  border-radius: 8px;
}
.dropdown {
  font-family: var(--font-family);
  background-color: var(--background-color);
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  max-height: 450px;
  overflow-y: auto;
  //min-width: 100%;
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: fit-content;
  position: absolute;
  top: 91% !important;
  z-index: 10;
  right: 0;
  .bi {
    margin-bottom: 0;
  }

  &--top {
    top: initial;
    bottom: 15px;
  }
  &--bottom {
    top: 8px;
  }

  &-search {
    margin-bottom: 10px;
  }

  &-button {
    margin-top: 4px;

    .show-more-btn {
      padding: 8px;
      outline: none;
      border: none;
      background-color: transparent;
      color: $gray-500;
      font-weight: var(--option-font-weight);
      line-height: 150%;

      &:hover {
        cursor: pointer;
        color: $gray-600;
      }
    }
  }

  &-groups {
    .group {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      span {
        color: var(--group-name-color);
        margin-bottom: 4px;
        margin-top: 4px;
        font-weight: var(--group-name-font-weight);
      }

      &:last-child {
        margin-bottom: 0;
      }
    }
  }

  &--lg {
    max-height: 230px;

    .dropdown-items {
      padding: 8px;
    }

    .show-more-btn,
    .dropdown-item--empty {
      font-size: 16px;
    }
    .group {
      margin-bottom: 16px;
      span {
        font-size: 14px;
      }
    }
  }
  &--md {
    max-height: 220px;
    .dropdown-items {
      padding: 6px;
    }

    .show-more-btn,
    .dropdown-item--empty {
      font-size: 14px;
    }
    .group {
      margin-bottom: 12px;
      span {
        font-size: 14px;
      }
    }
  }
  &--sm {
    max-height: 180px;

    .dropdown-items {
      padding: 6px;
    }

    .show-more-btn,
    .dropdown-item--empty {
      font-size: 12px;
    }
    .group {
      margin-bottom: 10px;
      span {
        font-size: 12px;
      }
    }
  }

  &--xs {
    max-height: 150px;
    .dropdown-items {
      padding: 4px;
    }

    .show-more-btn,
    .dropdown-item--empty {
      font-size: 10px;
    }
    .group {
      margin-bottom: 10px;
      span {
        font-size: 12px;
      }
    }
  }
}

.dropdown-item--empty {
  align-items: center;
  justify-content: center;
  color: $gray-500;
  padding: 8px 18px;
  cursor: default;
  font-weight: 400;

  &:hover {
    background-color: initial;
  }
}
</style>
