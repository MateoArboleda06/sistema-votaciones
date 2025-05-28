<template>
  <div class="max-w-md mx-auto mt-10 p-6 border rounded shadow">

    <h2 class="text-2xl font-bold mb-4">Registro</h2>

    <form @submit.prevent="register">

      <BaseInput
        v-model="form.name"
        label="Nombre"
        placeholder="Nombre"
        :required="true"
      />
      <p v-if="errors.name" class="text-red-500 text-sm mb-2">{{ errors.name }}</p>

      <BaseInput
        v-model="form.email"
        label="Correo"
        type="email"
        placeholder="Correo"
        :required="true"
      />
      <p v-if="errors.email" class="text-red-500 text-sm mb-2">{{ errors.email }}</p>

      <BaseInput
        v-model="form.password"
        label="Contraseña"
        type="password"
        placeholder="Contraseña"
        :required="true"
      />
      <p v-if="errors.password" class="text-red-500 text-sm mb-2">{{ errors.password }}</p>

      <BaseInput
        v-model="form.password_confirmation"
        label="Confirmar contraseña"
        type="password"
        placeholder="Confirmar contraseña"
        :required="true"
      />
      <p v-if="errors.password_confirmation" class="text-red-500 text-sm mb-2">{{ errors.password_confirmation }}</p>

      <BaseButton :onClick="register">Registrarse</BaseButton>
    </form>

    <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>

    <!-- Modal de confirmación -->
    <BaseModal v-model:show="showModal">
      <template #header>
        <h2 class="text-xl font-bold text-green-700">Registro exitoso</h2>
      </template>

      <p class="text-gray-700">El usuario ha sido registrado correctamente.</p>

      <template #footer>
        <BaseButton :onClick="closeModal">Cerrar</BaseButton>
      </template>
    </BaseModal>

  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import BaseInput from '@/components/BaseInput.vue';
import BaseButton from '@/components/BaseButton.vue';
import BaseModal from '@/components/BaseModal.vue';

const router = useRouter();

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'user'
});

const error = ref('');
const showModal = ref(false);

const errors = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

const validateForm = () => {

  errors.name = '';
  errors.email = '';
  errors.password = '';
  errors.password_confirmation = '';

  let valid = true;

  if (!form.name.trim()) {
    errors.name = 'El nombre es requerido';
    valid = false;
  }

  if (!form.email.trim()) {

    errors.email = 'El correo es requerido';
    valid = false;

  }
  
  if (!/\S+@\S+\.\S+/.test(form.email)) {
    errors.email = 'El correo no es válido';
    valid = false;
  }

  if (!form.password) {
    errors.password = 'La contraseña es requerida';
    valid = false;
  }
  
  if (form.password.length < 6) {
    errors.password = 'La contraseña debe tener al menos 6 caracteres';
    valid = false;
  }

  if (!form.password_confirmation) {
    errors.password_confirmation = 'Confirme la contraseña';
    valid = false;
  }
  
  if (form.password_confirmation !== form.password) {
    errors.password_confirmation = 'Las contraseñas no coinciden';
    valid = false;
  }

  return valid;
};

const register = async () => {
  error.value = '';

  if (!validateForm()) return;

  try {

    await axios.post('/api/register', form);    
    showModal.value = true;

  } catch (e) {
    error.value = 'Error en el registro';
  }
};

const closeModal = () => {
  showModal.value = false;
  router.push('/login');
};
</script>
