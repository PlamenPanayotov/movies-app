import Vue from 'vue';
import VueRouter from 'vue-router';
import Register from './components/User/Register'
import Login from './components/User/Login'
import Profile from './components/User/Profile'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/register', component: Register },
        { path: '/login', component: Login },
        { path: '/profile', component: Profile }
    ]
});


export default router;
