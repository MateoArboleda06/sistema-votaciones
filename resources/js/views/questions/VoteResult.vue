<template>
  <div>
    <h2>Resultados: {{ questionTitle }}</h2>
    <ul>
      <li v-for="(result, index) in results" :key="index">
        {{ result.option }} - {{ result.votes }} votos
      </li>
    </ul>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const results = ref([])
const questionTitle = ref('')

onMounted(async () => {
  const { data } = await axios.get(`/api/results/${route.params.id}`)
  questionTitle.value = data.question
  results.value = data.results
})
</script>
