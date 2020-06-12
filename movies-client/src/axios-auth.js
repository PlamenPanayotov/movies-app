import axios from 'axios';

// function checkToken(to, from, next) {

// }

const instance = axios.create({
    baseURL: 'https://localhost:8000/user/',
    headers: {
        'Content-type': 'application/json',
        'Access-Control-Allow-Origin': '*'
    }
});

instance.interceptors.request.use((config) => {
    config.url = `${config.url}`;
    return config;
});

export default instance;