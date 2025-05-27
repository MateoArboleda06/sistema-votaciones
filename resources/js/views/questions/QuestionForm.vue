<template>
  <div>
    <h2>Crear nueva pregunta</h2>
    <form @submit.prevent="submitForm">
        <div>
            <label for="title">Pregunta:</label>
            <input type="text" v-model="form.title" id="title" required />
        </div>

        <h3>Opciones</h3>
        <div v-for="(option, index) in form.options" :key="index">
            <input
            type="text"
            v-model="form.options[index].text"
            :placeholder="`Opción ${index + 1}`"
            required
            />
            <button type="button" @click="removeOption(index)" v-if="form.options.length > 2 && index >= 2">Eliminar</button>
        </div>
        <button type="button" @click="addOption">Agregar opción</button>

        <br /><br />
        <button type="submit">Guardar pregunta</button>
        <p v-if="message">{{ message }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const form = ref({
  title: '',
  options: [{ text: '' }, { text: '' }]
})

const message = ref('')

const addOption = () => {
  form.value.options.push({ text: '' })
}

const removeOption = (index) => {
  form.value.options.splice(index, 1)
}

const submitForm = async () => {
  try {
    await axios.post('/api/questions', form.value)
    message.value = 'Pregunta creada con éxito'
    form.value = {
      title: '',
      options: [{ text: '' }, { text: '' }]
    }
  } catch (error) {
    message.value = error.response?.data?.message || 'Error al crear la pregunta'
  }
}
</script>
