import VueRouter from 'vue-router';
import Home from './components/Home';
import Login from './components/User/Login';
import Register from './components/User/Register';
import Profile from './components/User/Profile';





const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,

        },
        {
            path: '/register', component: Register
        },
        {
            path: '/login', component: Login
        },
        {
            path: '/profile', component: Profile
        }
    ]
});


export default router;
