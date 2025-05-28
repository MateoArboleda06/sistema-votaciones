<template>
  <div class="max-w-md mx-auto mt-16 p-6 bg-white border rounded-2xl shadow-lg">

    <h2 class="text-3xl font-bold text-center mb-6 text-blue-700">Iniciar Sesión</h2>

    <form @submit.prevent="login">
      <BaseInput
        v-model="form.email"
        label="Correo electrónico"
        type="email"
        required
      />
      <p v-if="errors.email" class="text-red-500 text-sm mt-1">{{ errors.email }}</p>

      <BaseInput
        v-model="form.password"
        label="Contraseña"
        type="password"
        required
      />
      <p v-if="errors.password" class="text-red-500 text-sm mt-1">{{ errors.password }}</p>

      <div class="flex gap-4 mt-6">
        <BaseButton :onClick="login">Ingresar</BaseButton>
        <BaseButton :onClick="() => router.push('/register')">No tengo cuenta</BaseButton>
      </div>
    </form>

    <p v-if="error" class="text-red-500 mt-4 text-sm text-center">{{ error }}</p>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/index';
import BaseInput from '@/components/BaseInput.vue';
import BaseButton from '@/components/BaseButton.vue';

const auth = useAuthStore();
const router = useRouter();

const form = reactive({
  email: '',
  password: ''
});

const error = ref('');

const errors = reactive({
  email: '',
  password: ''
});

const validateForm = () => {

  errors.email = '';
  errors.password = '';

  let isValid = true;

  if (!form.email) {

    errors.email = 'El correo electrónico es requerido';
    isValid = false;

  }
  
  if (!/\S+@\S+\.\S+/.test(form.email)) {

    errors.email = 'El correo electrónico no es válido';
    isValid = false;
  }

  if (!form.password) {

    errors.password = 'La contraseña es requerida';
    isValid = false;

  }

  return isValid;
};

const login = async () => {
  error.value = '';

  if (!validateForm()) return;

  try {

    await auth.login(form);
    router.push('/inicio');

  } catch (err) {
    error.value = err.response?.data?.message || 'Credenciales inválidas';
  }
};
</script>
