<template>
  <div>
    <nav class="bg-blue-800 text-white px-4 py-3 flex justify-between items-center">
      <h1 class="text-lg font-semibold">Mi App</h1>
      <ul class="flex gap-4">
        <li><router-link to="/inicio">Inicio</router-link></li>
        <li v-if="auth.isAdmin"><router-link to="/admin/dashboard">Dashboard</router-link></li>
        <li v-if="auth.isAdmin"><router-link to="/">Votaciones</router-link></li>
        <li><button @click="logout" class="ml-4">Cerrar sesión</button></li>
      </ul>
    </nav>

    <main class="p-4">
        <!-- Aquí se renderiza el componente hijo -->
        <router-view />
    </main>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../store/index';

const auth = useAuthStore();
const router = useRouter();

const logout = async () => {
  await auth.logout();
  router.push('/login');
};
</script>
