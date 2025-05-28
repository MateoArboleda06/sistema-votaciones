<template>
  <div>
    <nav class="bg-blue-800 text-white px-6 py-4 flex justify-between items-center shadow-md">

      <h1 class="text-2xl font-bold tracking-wide">Votaciones Vecinales</h1>

      <!-- Botón hamburguesa -->
      <button @click="toggleMenu" class="md:hidden focus:outline-none">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path v-if="!menuOpen" d="M4 6h16M4 12h16M4 18h16" />
          <path v-else d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Menú -->
      <ul class="hidden md:flex gap-6 items-center text-white font-medium">
        <li>
          <router-link to="/inicio" class="hover:underline">Inicio</router-link>
        </li>
        <li v-if="auth.isAdmin">
          <router-link to="/admin/dashboard" class="hover:underline">Dashboard</router-link>
        </li>
        <li>
          <BaseButton @click="logout" class="bg-red-500 hover:bg-red-600 text-white">
            Cerrar sesión
          </BaseButton>
        </li>
      </ul>
    </nav>

    <!-- Menú móvil -->
    <transition name="fade">
      <div
        v-if="menuOpen"
        class="md:hidden bg-blue-700 text-white px-6 py-4 space-y-3 font-medium shadow-md"
      >
        <router-link to="/inicio" class="block hover:underline" @click="closeMenu">Inicio</router-link>
        <router-link v-if="auth.isAdmin" to="/admin/dashboard" class="block hover:underline" @click="closeMenu">Dashboard</router-link>
        <BaseButton @click="logout" class="w-full bg-red-500 hover:bg-red-600 text-white mt-2">
          Cerrar sesión
        </BaseButton>
      </div>
    </transition>

    <main class="p-6 bg-gray-50 min-h-screen">
      <router-view />
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../store/index';
import BaseButton from '@/components/BaseButton.vue';

const auth = useAuthStore();
const router = useRouter();

const menuOpen = ref(false);
const toggleMenu = () => (menuOpen.value = !menuOpen.value);
const closeMenu = () => (menuOpen.value = false);

const logout = async () => {
  await auth.logout();
  closeMenu();
  router.push('/login');
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
