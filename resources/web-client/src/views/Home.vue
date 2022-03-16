<template>

    <template v-if="user">
        <header>
            <Navbar
                :user="user"
            />
        </header>


        <main>

            <div class="flex flex-col md:flex-row">

                <Sidebar />

                <section class="w-full">
                    <div id="main" class="main-content flex-1 mt-12 md:mt-2 pb-24 md:pb-5">

                        <div class="bg-gray-800 pt-14">
                            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                                <h1 class="font-bold pl-2">Welcome!</h1>
                            </div>
                        </div>

                        <div class="p-6">
                            <router-view />
                        </div>

                    </div>
                </section>
            </div>
        </main>
    </template>
    <div v-else>
        <Spinner />
    </div>

</template>

<script>
import Sidebar from '../components/Sidebar'
import Navbar from '../components/Navbar'
import {onBeforeMount, ref} from 'vue'
import {useRouter} from 'vue-router'
import axios from 'axios'
import Spinner from '../components/Spinner'

export default {
    name: 'Home',
    components: {Spinner, Navbar, Sidebar},

    setup() {
        const router = useRouter()
        const user = ref(null)
        onBeforeMount (async () => {
            try {
                const response = await axios.get('/user')
                user.value = response.data.user
            } catch (e) {
                await router.push({name: 'Login'})
            }
        })
        return {user}
    }
}
</script>
