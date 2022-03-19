<template>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
            <h3 class="text-2xl font-bold text-center">Create a new account</h3>
            <form @submit.prevent="submit">
                <div class="mt-4">
                    <div class="mt-4">
                        <label class="block">First Name</label>
                        <input
                            type="text"
                            placeholder="First Name..."
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="fName"
                        />
                    </div>
                    <div class="mt-4">
                        <label class="block">Last Name</label>
                        <input
                            type="text"
                            placeholder="Last Name..."
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="lName"
                        />
                    </div>
                    <div class="mt-4">
                        <label class="block">Email</label>
                        <input
                            type="email"
                            placeholder="Email"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="email"
                        />
                    </div>
                    <div class="mt-4">
                        <label class="block">Image</label>
                        <input
                            type="text"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="image"
                        />
                        <div class="mt-4">
                            <UploadHandler @fileUploaded="image = $event" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block">Password</label>
                        <input
                            type="password"
                            placeholder="Password"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="pwd"
                        />
                    </div>
                    <div class="mt-4">
                        <label class="block">Repeat Password</label>
                        <input
                            type="password"
                            placeholder="Repeat Password"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            v-model="pwdConfirm"
                        />
                    </div>
                    <div class="flex items-baseline justify-between">
                        <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Register</button>
                        <p class="mx-4">Already have one? -></p>
                        <router-link
                            :to="{name: 'Login'}"
                            class="text-blue-600 hover:underline"
                        >
                            Login
                        </router-link>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
import UploadHandler from '../components/UploadHandler'
import {ref} from 'vue'
import {useRouter} from 'vue-router'
import axios from 'axios'

export default {
    name: 'Register',
    components: {UploadHandler},

    setup() {
        const fName = ref('')
        const lName = ref('')
        const image = ref('')
        const email = ref('')
        const pwd = ref('')
        const pwdConfirm = ref('')
        const router = useRouter()

        const submit = async () => {
            await axios.post('/register', {
                first_name: fName.value,
                last_name: lName.value,
                email: email.value,
                image: image.value,
                password: pwd.value,
                password_confirm: pwdConfirm.value,
            })
            await router.push({name: 'Login'})
        }

        return {
            fName,
            lName,
            image,
            email,
            pwd,
            pwdConfirm,
            submit
        }
    }
}
</script>
