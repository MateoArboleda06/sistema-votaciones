<template>
  <div class="mb-4">
    <label
      class="block mb-1 text-sm font-medium text-gray-700"
      :for="`base-input-${_uid}`"
    >{{ label }}</label>
      
    <input
      :id="`base-input-${_uid}`"
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
      :placeholder="placeholder"
      :required="required"
    />
  </div>
</template>

<script setup>
defineProps({
  modelValue: String,
  label: String,
  type: {
    type: String,
    default: 'text',
  },
  placeholder: {
    type: String,
    default: '',
  },
  required: {
    type: Boolean,
    default: false,
  },
});

defineEmits(['update:modelValue']);
</script>
