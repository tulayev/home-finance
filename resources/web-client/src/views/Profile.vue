<template>
    <h1>Profile</h1>

    <div
        class="flex justify-between"
        v-if="user"
    >
        <form
            class="w-1/2 max-w-lg"
            @submit.prevent="submitInfo"
        >
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        First Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        type="text"
                        v-model="fName"
                    />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Last Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="text"
                        v-model="lName"
                    />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3  md:w-1/2 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Image
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="text"
                        v-model="image"
                    />
                    <UploadHandler
                        @fileUploaded="image = $event"
                        :id="user.id"
                    />
                </div>

                <div class="w-full px-3  md:w-1/2 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Email
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        type="email"
                        v-model="email"
                    />
                </div>
            </div>

            <div class="mt-4">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Изменить
                </button>
            </div>
        </form>

        <form
            class="w-1/2 max-w-lg"
            @submit.prevent="submitPassword"
        >
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Password
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        type="password"
                        v-model="pwd"
                        required
                    />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Password Confirmation
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="password"
                        v-model="pwdConfirm"
                        required
                    />
                </div>
            </div>

            <div class="mt-2">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Изменить
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
import {onMounted, ref} from 'vue'
import UploadHandler from '../components/UploadHandler'
import router from "@/router";
export default {
    name: 'Profile',
    components: {UploadHandler},

    setup() {
        const user = ref(null)
        const fName = ref('')
        const lName = ref('')
        const email = ref('')
        const pwd = ref('')
        const pwdConfirm = ref('')
        const image = ref('')

        onMounted(async () => {
            const response = await axios.get('/user')
            user.value = response.data.user
            console.log(user.value.first_name)

            fName.value = user.value.first_name
            lName.value = user.value.last_name
            email.value = user.value.email
            image.value = user.value.image
        })

        const submitInfo = async () => {
            await axios.put('/user/info', {
                first_name: fName.value,
                last_name: lName.value,
                email: email.value,
                image: image.value,
            })

            router.go(0)
        }

        const submitPassword = async () => {
            await axios.put('/user/password', {
                password: pwd.value,
                password_confirm: pwdConfirm.value,
            })

            router.go(0)
        }

        return {
            user,
            fName,
            lName,
            email,
            pwd,
            pwdConfirm,
            image,
            submitInfo,
            submitPassword
        }
    }
}
</script>
