// store/index.js
import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem('auth_token') || null,
    }),
    
    actions: {
        async login(credentials) {

            const res = await axios.post('/api/login', credentials);    

            const token = `${res.data.token_type} ${res.data.access_token}`;
            this.token = token;

            localStorage.setItem('auth_token', token);
            axios.defaults.headers.common['Authorization'] = token;

            await this.fetchUser();
        },

        async fetchUser() {
            try {

                const res = await axios.get('/api/user');

                this.user = res.data;

            } catch (error) {
                this.user = null;
            }
        },

        async logout() {
            try {
                await axios.post('/api/logout');
            } catch {}
            this.user = null;
            this.token = null;
            localStorage.removeItem('auth_token');
            delete axios.defaults.headers.common['Authorization'];
        }
    },

    getters: {
        isAdmin: (state) => {
            return state.user?.roles?.some(role => role.name === 'administrador') || false;
        }
    }
});
