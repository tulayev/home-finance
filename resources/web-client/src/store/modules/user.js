import axios from 'axios'

export default {
   //namespaced: true,

    state: {
        token: "",
        isLoggedIn: false,
        user: null,
    },

    getters: {
        token: state => {
            return state.token
        },
        user: state => {
            return state.user
        },
        isLoggedIn: state => {
            return state.isLoggedIn
        }
    },

    mutations: {
        SET_USER(state, payload) {
            state.token = payload.token
            state.user = payload.user
            state.isLoggedIn = true
        }
    },

    actions: {
        async login({commit}, data) {
            return await axios.post('/login', data)
                .then(res => {
                    commit('SET_USER', res.data)
                })
                .catch(err => {
                    console.log(err.message)
                })
        },
    },
}
