<template>
  <transition name="fade">
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
      <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 relative">
        <button
          @click="close"
          class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-lg font-bold"
        >
          &times;
        </button>
        <slot name="header">
          <h2 class="text-xl font-bold mb-4 text-gray-800">Modal</h2>
        </slot>
        <div class="modal-body">
          <slot />
        </div>
        <div class="mt-4 text-right">
          <slot name="footer" />
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  show: Boolean,
})

const emit = defineEmits(['update:show'])

const close = () => emit('update:show', false)
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.25s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
