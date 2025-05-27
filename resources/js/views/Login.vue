<template>
  <div class="max-w-md mx-auto mt-10 p-6 border rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Iniciar Sesión</h2>
    <form @submit.prevent="login">
      <div class="mb-4">
        <label>Email</label>
        <input v-model="form.email" type="email" class="w-full border px-3 py-2 rounded" required />
      </div>
      <div class="mb-4">
        <label>Contraseña</label>
        <input v-model="form.password" type="password" class="w-full border px-3 py-2 rounded" required />
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ingresar</button>
      <button class="bg-blue-600 text-white px-4 py-2 rounded" @click="router.push('/register')">No tengo Cuenta</button>
    </form>
    <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/index';

const auth = useAuthStore();
const router = useRouter();

const form = reactive({
  email: '',
  password: ''
});

const error = ref('');

const login = async () => {

  error.value = '';

  try {

    await auth.login(form);
    router.push('/inicio');

  } catch (err) {
    error.value = err.response?.data?.message || 'Credenciales inválidas';
  }
};
</script>
