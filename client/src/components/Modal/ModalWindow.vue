<template>
  <Transition name="modal">
    <div v-if="show" class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container" ref="modal" id="modal">
          <OnClickOutside @trigger="close">
            <div class="wrapper">
              <div class="modal-header" :class="{ flex: !showCloseIcon }">
                <h3><slot name="header"></slot></h3>

                <div v-if="showCloseIcon" @click="emit('close')" class="close">
                  <CloseSVG />
                </div>
              </div>

              <div class="modal-body">
                <slot name="body" />
              </div>

              <div class="modal-footer">
                <slot name="footer" />
              </div>
            </div>
          </OnClickOutside>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, ref, onMounted } from 'vue'
import CloseSVG from '@/components/SvgIcons/CloseSVG.vue'
import { OnClickOutside } from '@vueuse/components'

const props = defineProps({
  show: Boolean,
  showCloseIcon: {
    type: Boolean,
    default: true,
  },
})

const emit = defineEmits(['close'])

const close = (e: any) => {
  emit('close')
}
</script>

<style lang="scss" scoped>
@import '@/assets/style/variables.scss';

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 416px;
  margin: 0 auto;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  background: #fff;
  border-radius: 28px;
}

.wrapper {
  padding: 40px;
}
.modal-header {
  display: grid;
  grid-template-columns: 1fr 20px;
  grid-column-gap: 25px;
  align-items: center;

  h3 {
    margin-top: 0;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    color: $gray-800;
  }

  .close {
    width: 16px;
    height: 16px;
    cursor: pointer;
    stroke: $gray-800;
  }
}

.modal-header.flex {
  display: flex;
  text-align: center;

  h3 {
    font-weight: 700;
    font-size: 16px;
    line-height: 19px;
  }
}

.modal-body {
}

.modal-footer {
  display: flex;
  gap: 24px;
  margin-top: 25px;
}

.modal-default-button {
  float: right;
}

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  //  -webkit-transform: scale(1.1);
  //  transform: scale(1.1);
  transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}

@media (max-width: 500px) {
  .modal-container {
    width: 100%;
    padding: 30px 20px;
    height: 100vh;
    overflow-y: auto;
    border-radius: 0;
  }

  .modal-header {
    h3 {
      font-size: 16px;
      font-weight: 500;
    }
  }
}
</style>
