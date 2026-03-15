import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';
// Using Vite Proxy instead of direct URL to fix Firefox Network Errors
window.axios.defaults.baseURL = ''; 
