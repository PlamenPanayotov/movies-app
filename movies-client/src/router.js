import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,
            meta: {
                resources: {
                    movies: 'https://api.themoviedb.org/3/movie/550?api_key=f5f5b5a829995b40eac24b23b82de87f'
                }
            }
        },
        {
            path: '/register', component: () => import('./components/User/Register')
        },
        {
            path: '/login', component: () => import('./components/User/Login')
        },
        {
            path: '/profile', component: () => import('./components/User/Profile')
        }
    ]
});
router.beforeEach((to, from, next) => {
    
});


export default router;
