<template>
    <div>
        <h1>Preguntas disponibles</h1>
        <ul v-if="questions.length">
        <li v-for="question in questions" :key="question.id">
            <router-link :to="`/questions/${question.id}`">
                {{ question.title }}
            </router-link>
        </li>
        </ul>
        <div v-else>
            <p>No hay preguntas registradas.</p>
            <router-link :to="`/inicio`" class="text-blue-600 hover:underline">
                <button>Volver al inicio</button>
            </router-link>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios';

const questions = ref([])

onMounted(async () => {
  const { data } = await axios.get('/api/questions')
  questions.value = data
})
</script>
