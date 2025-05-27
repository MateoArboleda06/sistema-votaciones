import axios from 'axios';

const token = localStorage.getItem('auth_token');

if (token) {
    axios.defaults.headers.common['Authorization'] = token;
}

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept'] = 'application/json';

export default axios;
