import axios from 'axios';

const instance = axios.create({
    baseURL: 'https://localhost:8000/',
    headers: { 'Content-type': 'application/json' }
});

instance.interceptors.request.use((config) => {
    config.url = `${config.url}`;
    return config;
});

export default instance;