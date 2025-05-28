<template>
  <div class="max-w-3xl mx-auto mt-8 space-y-6">
    <BaseCard class="p-6 bg-white shadow-md rounded-2xl">
      <div class="flex items-center gap-3 mb-4">
        <h1 class="text-2xl font-bold text-blue-800">Panel de Administrador</h1>
      </div>

      <p class="text-gray-700">Bienvenido, <strong>{{ auth.user.name }}</strong></p>

      <div class="mt-6 flex flex-col sm:flex-row gap-4">
        <router-link to="/admin/questions/create" class="w-full sm:w-auto">
          <BaseButton class="bg-blue-600 hover:bg-blue-700 text-white w-full">
            Crear nueva pregunta
          </BaseButton>
        </router-link>
      </div>
    </BaseCard>
  </div>
</template>

<script setup>
import { useAuthStore } from '../store';
import { useRouter } from 'vue-router';
import BaseButton from '@/components/BaseButton.vue'
import BaseCard from '@/components/BaseCard.vue'

const auth = useAuthStore();
const router = useRouter();
</script>
