import './bootstrap';
import './style.css';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import { useAuthStore } from './stores/auth';

const app = createApp(App);
const pinia = createPinia();
app.use(pinia);

// Initialize auth store (set token in axios)
const auth = useAuthStore();
auth.initialize();

app.use(router);
app.mount('#app');
