import axios from 'axios';

// function checkToken(to, from, next) {

// }

const instance = axios.create({
    baseURL: 'https://localhost:8000/api/',
    headers: {
        'Content-type': 'application/json'
    }
});

instance.interceptors.request.use((config) => {
    config.url = `${config.url}`;
    return config;
});

export default instance;