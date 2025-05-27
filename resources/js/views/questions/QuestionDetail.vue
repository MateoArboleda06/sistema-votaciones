<template>
    <div v-if="question">
        <h2>{{ question.title }}</h2>
        <form @submit.prevent="submitVote">
            <div v-for="option in question.options" :key="option.id">
                <label>
                    <input type="radio" :value="option.id" v-model="selectedOption" />
                    {{ option.text }}
                </label>
            </div>
            <button type="submit">Votar</button>
        </form>

        <router-link :to="`/admin/results/${question.id}`" v-if="auth.isAdmin" class="text-blue-600 hover:underline">
            <button>Ver Resultados</button>
        </router-link>

        <div v-if="message" class="message">{{ message }}</div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useAuthStore } from '../../store/index'
import axios from 'axios'

const route = useRoute()
const auth = useAuthStore()

const question = ref(null)
const selectedOption = ref(null)
const message = ref('')

onMounted(async () => {
  const { data } = await axios.get(`/api/questions/${route.params.id}`)
  question.value = data
})

const submitVote = async () => {
  try {
    await axios.post('/api/votes', { option_id: selectedOption.value })
    message.value = '¡Tu voto ha sido registrado!'
  } catch (error) {
    message.value = error.response?.data?.message || 'Ocurrió un error'
  }
}
</script>
