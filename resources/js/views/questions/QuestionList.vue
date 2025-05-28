<template>

    <div v-if="loading" class="flex justify-center items-center h-40">
        <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </div>

    <div v-else class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">
        Preguntas Disponibles
        </h1>

        <div v-if="questions.length" class="grid gap-4 md:grid-cols-2">
        <BaseCard
            v-for="question in questions"
            :key="question.id"
            class="hover:shadow-lg transition duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6M4 6h16M4 6v14a2 2 0 002 2h12a2 2 0 002-2V6M4 6h16" />
            </svg>

            <router-link :to="`/questions/${question.id}`" class="text-blue-700 hover:underline font-medium">
            {{ question.title }}
            </router-link>
        </BaseCard>
        </div>

        <div v-else class="text-center mt-10">
        <p class="text-gray-600 mb-4">No hay preguntas registradas.</p>
        <router-link to="/inicio">
            <BaseButton class="bg-blue-600 hover:bg-blue-700 text-white">
            Volver al inicio
            </BaseButton>
        </router-link>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import BaseButton from '@/components/BaseButton.vue'
import BaseCard from '@/components/BaseCard.vue'

const questions = ref([])
const loading = ref(true)

onMounted(async () => {
    try {
        const { data } = await axios.get('/api/questions')
        questions.value = data
    } catch (error) {
        questions.value = null
    } finally {
        loading.value = false
    }
})
</script>
