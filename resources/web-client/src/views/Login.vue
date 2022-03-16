<template>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
            <h3 class="text-2xl font-bold text-center">Login to your account</h3>

            <ValidationErrors
                :errors="error"
            />

            <form @submit.prevent="submit">
                <div class="mt-4">
                    <div>
                        <label class="block">Email</label>
                        <input
                            type="email"
                            placeholder="Email"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="email"
                        />
                    </div>
                    <div class="mt-4">
                        <label class="block">Password</label>
                        <input
                            type="password"
                            placeholder="Password"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="password"
                        />
                    </div>
                    <div class="flex items-baseline justify-between">
                        <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Login</button>
                        <p class="mx-4">Don't have an account yet? -></p>
                        <router-link
                            :to="{name: 'Register'}"
                            class="text-blue-600 hover:underline"
                        >
                            Register
                        </router-link>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
import {ref} from 'vue'
import axios from 'axios'
import {useRouter} from 'vue-router'
import ValidationErrors from '../components/ValidationErrors'

export default {
    name: 'Login',
    components: {ValidationErrors},
    setup() {
        const email = ref('')
        const password = ref('')
        const router = useRouter()
        const error = ref(null)

        const submit = async () => {
            try {
                const response = await axios.post('/login', {
                    email: email.value,
                    password: password.value
                })

                localStorage.setItem('token', response.data.token)
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`

                await router.push({name: 'Home'})
            } catch (e) {
                error.value = e.response.data.error
            }
        }

        return {
            email,
            password,
            error,
            submit
        }

    }
}
</script>
