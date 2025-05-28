<template>
    <BaseModal v-model:show="showModal">
        <template #header>
            <h2 class="text-xl font-bold text-blue-700">Información</h2>
        </template>
        <template #default>
            <p>{{ modalMessage }}</p>
        </template>
        <template #footer>
            <BaseButton @click="showModal = false">Cerrar</BaseButton>
        </template>
    </BaseModal>

    <div v-if="loading" class="flex justify-center items-center h-40">
        <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </div>

    <div v-else-if="question" class="max-w-2xl mx-auto py-10 px-4">
        <BaseCard  class="space-y-6">
        <h2 class="text-xl font-semibold text-gray-800">{{ question.title }}</h2>

        <form @submit.prevent="submitVote" class="space-y-4">
            <div v-for="option in question.options" :key="option.id" class="flex items-center gap-2">
            <input
                type="radio"
                :value="option.id"
                v-model="selectedOption"
                id="option-{{ option.id }}"
                class="accent-blue-600"
            />
            <label :for="`option-${option.id}`" class="text-gray-700">
                {{ option.text }}
            </label>
            </div>

            <BaseButton
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white w-full mt-4"
            >
                Votar
            </BaseButton>
        </form>

        <router-link
            :to="`/admin/results/${question.id}`"
            v-if="auth.isAdmin"
            class="block text-center mt-6"
        >
            <BaseButton class="bg-gray-400 hover:bg-gray-500 text-gray-900 w-full">
                Ver Resultados
            </BaseButton>
        </router-link>

        <p
            v-if="message"
            class="text-center mt-4 font-medium"
            :class="{
            'text-green-600': message.includes('registrado'),
            'text-red-500': message.includes('error')
            }"
        >
            {{ message }}
        </p>
        </BaseCard>
    </div>

    <div v-else class="text-center mt-10 text-gray-500">
      <p>No se encontró la pregunta.</p>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useAuthStore } from '../../store/index'
import BaseButton from '@/components/BaseButton.vue'
import BaseCard from '@/components/BaseCard.vue'
import BaseModal from '@/components/BaseModal.vue'

const route = useRoute()
const auth = useAuthStore()

const question = ref(null)
const selectedOption = ref(null)
const loading = ref(true)
const showModal = ref(false)
const modalMessage = ref('')

onMounted(async () => {
  try {
    const { data } = await axios.get(`/api/questions/${route.params.id}`)
    question.value = data
  } catch {
    question.value = null
  } finally {
    loading.value = false
  }
})

const submitVote = async () => {
    if (!selectedOption.value) return

    try {
        await axios.post('/api/votes', { option_id: selectedOption.value })
        modalMessage.value = '¡Tu voto ha sido registrado con éxito!'
        showModal.value = true
    } catch (error) {
        modalMessage.value = error.response?.data?.message || 'Ocurrió un error al registrar tu voto.'
        showModal.value = true
    }
}
</script>
