<template>
  <div class="max-w-md mx-auto mt-10 p-6 border rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Registro</h2>
    <form @submit.prevent="register">
      <input v-model="form.name" placeholder="Nombre" class="mb-2 w-full border p-2" />
      <input v-model="form.email" placeholder="Correo" class="mb-2 w-full border p-2" />
      <input v-model="form.password" placeholder="Contraseña" type="password" class="mb-2 w-full border p-2" />
      <input v-model="form.password_confirmation" placeholder="Confirmar contraseña" type="password" class="mb-2 w-full border p-2" />
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Registrarse</button>
    </form>
    <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'user'
});

const error = ref('');

const register = async () => {
  try {
    await axios.post('/api/register', form);
    router.push('/login');
    alert('Usuario registrado');
  } catch (e) {
    error.value = 'Error en el registro';
  }
};
</script>
