<template>
  <div>
    <h2>Bienvenido</h2>
    <p>{{ auth.user?.name }}</p>
  </div>
</template>

<script setup>
import { useAuthStore } from '../store/index';
import { useRouter } from 'vue-router';
import { onMounted } from 'vue';

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
