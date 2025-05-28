<template>
    <div class="max-w-2xl mx-auto mt-6 space-y-6">
        <BaseCard class="p-6 bg-white shadow-md rounded-2xl">
            <h2 class="text-2xl font-semibold text-blue-800 mb-6 flex items-center gap-2">
                Resultados: {{ questionTitle }}
            </h2>

            <ul class="space-y-4">
                <li
                v-for="(result, index) in animatedResults"
                :key="index"
                class="space-y-1"
                >
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-800">{{ result.option }}</span>
                        <span class="font-semibold text-blue-700">{{ result.percentage }}%</span>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div
                        class="bg-blue-600 h-full transition-all duration-1000 ease-out"
                        :style="{ width: `${result.animatedWidth}%` }"
                        ></div>
                    </div>

                    <div class="text-sm text-gray-500 text-right">
                        {{ result.votes }} voto{{ result.votes !== 1 ? 's' : '' }}
                    </div>
                </li>
            </ul>
        </BaseCard>

        <router-link to="/inicio">
            <BaseButton class="w-full bg-blue-600 hover:bg-blue-700 text-white">
                Volver al inicio
            </BaseButton>
        </router-link>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import BaseButton from '@/components/BaseButton.vue'
import BaseCard from '@/components/BaseCard.vue'

const route = useRoute()
const results = ref([])
const animatedResults = ref([])
const questionTitle = ref('')
const totalVotes = ref(0)

onMounted(async () => {
  const { data } = await axios.get(`/api/results/${route.params.id}`)

  questionTitle.value = data.question
  results.value = data.results
  totalVotes.value = results.value.reduce((sum, result) => sum + result.votes, 0)

  // Calcular porcentaje y preparar resultados animados
  animatedResults.value = results.value.map((result) => {
    const percentage = totalVotes.value === 0 ? 0 : ((result.votes / totalVotes.value) * 100)
    return {
      ...result,
      percentage,
      animatedWidth: 0,
    }
  })

  // Activar animación después de un pequeño delay
  setTimeout(() => {
    animatedResults.value.forEach((option, index) => {
      option.animatedWidth = option.percentage
    })
  }, 100)
})
</script>
