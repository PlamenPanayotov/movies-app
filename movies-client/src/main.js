import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './router';
import store from './assets/js/store/authentication-store'


Vue.use(VueRouter);

Vue.config.productionTip = false


new Vue({
  render: h => h(App),
  router,
  store
}).$mount('#app')
