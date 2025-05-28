import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import axios from './bootstrap';
import '../css/app.css'

const app = createApp(App);

app.config.globalProperties.$axios = axios;

app.use(router);
app.use(createPinia());
app.mount('#app');
