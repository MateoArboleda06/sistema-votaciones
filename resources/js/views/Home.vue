<template>
  <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-xl">

    <h2 class="text-3xl font-bold text-blue-700 mb-2">¡Hola, {{ auth.user?.name }}!</h2>
    <p class="text-gray-600 mb-6">Bienvenido al sistema de votaciones de tu conjunto residencial.</p>

    <div class="space-y-4 mb-6">
      <div class="flex items-start gap-3">
        <span class="text-blue-600 text-xl">🗳️</span>
        <p>Participa en <strong>votaciones activas</strong> y haz valer tu voz.</p>
      </div>
      <div class="flex items-start gap-3">
        <span class="text-green-600 text-xl">📊</span>
        <p>Consulta los <strong>resultados anteriores</strong> y las decisiones tomadas.</p>
      </div>
      <div class="flex items-start gap-3">
        <span class="text-yellow-600 text-xl">📅</span>
        <p>Infórmate sobre <strong>próximas asambleas</strong> y eventos del conjunto.</p>
      </div>
    </div>

    <div class="text-right">
      <router-link to="/questions">
        <BaseButton>Ver votaciones disponibles</BaseButton>
      </router-link>
    </div>

  </div>
</template>

<script setup>
import { useAuthStore } from '../store';
import { useRouter } from 'vue-router';
import { onMounted } from 'vue';
import BaseButton from '@/components/BaseButton.vue';

const auth = useAuthStore();
const router = useRouter();

onMounted(async () => {
  try {
    if (!auth.user) {
      await auth.fetchUser();
    }
  } catch {
    router.push('/login');
  }
});
</script>
