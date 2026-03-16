import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: JSON.parse(localStorage.getItem('user')) || null,
        token: localStorage.getItem('access_token') || null,
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        async login(credentials) {
            try {
                const response = await axios.post('/api/login', credentials);
                this.user = response.data.user;
                this.token = response.data.access_token;

                localStorage.setItem('access_token', this.token);
                localStorage.setItem('user', JSON.stringify(this.user));

                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
                return response.data;
            } catch (error) {
                throw error;
            }
        },
        async register(userData) {
            try {
                const response = await axios.post('/api/register', userData);
                this.user = response.data.user;
                this.token = response.data.access_token;

                localStorage.setItem('access_token', this.token);
                localStorage.setItem('user', JSON.stringify(this.user));

                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
                return response.data;
            } catch (error) {
                throw error;
            }
        },
        async logout() {
            try {
                await axios.post('/api/logout');
            } catch (error) {
                console.error('Logout error', error);
            } finally {
                this.user = null;
                this.token = null;
                localStorage.removeItem('access_token');
                localStorage.removeItem('user');
                delete axios.defaults.headers.common['Authorization'];
            }
        },
        initialize() {
            if (this.token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            }
        }
    }
});
