import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import authAxios from "@/axios-auth";

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: {}
    },
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, token, user) {
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = ''
            state.token = ''
        },
    },
    actions: {
        login({ commit }, user) {

            authAxios.post('/login', user)
                .then(resp => {
                    console.log(resp)
                    const { token, user } = resp.data;
                    localStorage.setItem('token', token)
                    localStorage.setItem('user', user)
                    // Add the following line:
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_success', token, user)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('token')
                    console.log(err)
                })
        },
        register({ commit }, user) {
            authAxios.post('/register', user)
                .then(res => {
                    console.log(res)
                    commit('auth_success', user)
                })
                .catch(err => {
                    console.log(err)
                })
        },
        logout({ commit }) {

            commit('logout')
            localStorage.removeItem('token')
            delete axios.defaults.headers.common['Authorization']

        }
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
    }
})
