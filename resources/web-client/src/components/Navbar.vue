<template>

    <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

        <div class="flex flex-wrap justify-between">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                <router-link
                    :to="{name: 'Home'}"
                    class="text-2xl p-2 hover:text-blue-600"
                >
                    Home Finance
                </router-link>
            </div>

            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <div class="relative inline-block">
                            <button
                                @click="toggle"
                                v-if="user"
                                class="drop-button text-white py-2 px-2"
                            >
                                <img
                                    class="rounded-full w-10 h-10 inline"
                                    :src="user.image_path"
                                    alt="Avatar"
                                >
                                Hi, {{user.first_name}}
                                <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                            </button>
                            <div id="myDropdown" class="w-40 dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                                <router-link
                                    :to="{name: 'Profile'}"
                                    class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block z-50"
                                >
                                    <i class="fa fa-user fa-fw"></i>
                                    Profile
                                </router-link>
                                <div class="border border-gray-800"></div>
                                <a
                                    href="javascript:void(0)"
                                    class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"
                                    @click="logout"
                                >
                                    <i class="fas fa-sign-out-alt fa-fw"></i>
                                    Log Out
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

</template>

<script>
import {useRouter} from 'vue-router'

export default {
    name: 'Navbar',
    props: {
        user: Object
    },

    setup() {
        const router = useRouter()

        const logout = () => {
            localStorage.clear()
            router.push({name: 'Login'})
        }

        const toggle = () => {
            const menu = document.getElementById('myDropdown')

            menu.classList.contains('invisible')
                ? menu.classList.remove('invisible')
                : menu.classList.add('invisible')
        }
        return {
            toggle,
            logout
        }
    }
}
</script>
