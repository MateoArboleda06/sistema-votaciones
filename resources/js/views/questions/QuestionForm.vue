<template>
  <div class="max-w-2xl mx-auto bg-white rounded-xl p-6 shadow mt-6">
    <h2 class="text-2xl font-bold text-blue-800 mb-4">Crear nueva pregunta</h2>

    <form @submit.prevent="submitForm" class="space-y-4">
      <BaseInput
        label="Pregunta"
        v-model="form.title"
        placeholder="Escribe la pregunta aquí"
        required
      />

      <h3 class="text-lg font-semibold text-gray-700">Opciones</h3>

      <div v-for="(option, index) in form.options" :key="index" class="flex items-center gap-2">
        <BaseInput
          v-model="form.options[index].text"
          :placeholder="`Opción ${index + 1}`"
          required
        />
        <button
          type="button"
          class="text-red-500 hover:text-red-700"
          v-if="form.options.length > 2 && index >= 2"
          @click="removeOption(index)"
        >
          Eliminar
        </button>
      </div>

      <button
        type="button"
        @click="addOption"
        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded"
      >
        Agregar opción
      </button>

      <div class="pt-4">
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded w-full"
        >
          Guardar pregunta
        </button>
      </div>
    </form>

    <!-- Modal de confirmación -->
    <BaseModal v-model:show="showModal">
      <template #header>
        <h2 class="text-xl font-semibold text-green-700">¡Pregunta creada!</h2>
      </template>

      <div class="text-gray-700 text-center">
        La pregunta fue guardada exitosamente.
      </div>

      <template #footer>
        <button
          class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
          @click="showModal = false"
        >
          Cerrar
        </button>
      </template>
    </BaseModal>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import BaseInput from '@/components/BaseInput.vue'
import BaseModal from '@/components/BaseModal.vue'

const form = ref({
  title: '',
  options: [{ text: '' }, { text: '' }],
})

const showModal = ref(false)

const addOption = () => {
  form.value.options.push({ text: '' })
}

const removeOption = (index) => {
  form.value.options.splice(index, 1)
}

const submitForm = async () => {
  try {
    await axios.post('/api/questions', form.value)
    showModal.value = true
    form.value = {
      title: '',
      options: [{ text: '' }, { text: '' }],
    }
  } catch (error) {
    console.error(error)
  }
}
</script>
