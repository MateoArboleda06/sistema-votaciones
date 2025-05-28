<template>
  <button
    @click="onClick"
    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
  >
    <slot />
  </button>
</template>

<script setup>
defineProps(['onClick']);
</script>
