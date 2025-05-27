<template>
    <div class="p-6">
      <h1 class="text-2xl font-bold text-blue-700">Panel de Administrador</h1>
      <p>Bienvenido, {{ auth.user.name }}</p>
  
      <div class="mt-4">
        <button class="bg-green-600 text-white px-4 py-2 rounded" @click="goToCreateUser">
          Crear nuevo usuario
        </button>

        <router-link :to="`/admin/questions/create`" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded">
          <button>Crear nueva pregunta</button>
        </router-link>
      </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '../store';
import { useRouter } from 'vue-router';

const auth = useAuthStore();
const router = useRouter();

const goToCreateUser = () => {
  // ejemplo de navegación extra
  alert('Aquí iría la vista de creación de usuario');
};
</script>
