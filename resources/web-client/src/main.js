import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/css/style.css'
import 'flowbite'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api'
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`

createApp(App).use(store).use(router).mount('#app')
