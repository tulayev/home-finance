<template>

    <ValidationErrors
        :errors="error"
    />

    <form
        class="w-full max-w-lg mx-auto"
        @submit.prevent="submit"
    >

        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Название
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text"
                    v-model="name"
                />
            </div>
        </div>

        <div class="mt-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Изменить
            </button>
        </div>
    </form>


</template>

<script>
import {onMounted, ref} from 'vue'
import axios from 'axios'
import {useRoute, useRouter} from 'vue-router'
import ValidationErrors from '../../components/ValidationErrors'

export default {
    name: 'Edit',
    components: {ValidationErrors},

    setup() {
        const name = ref('')
        const {params} = useRoute()
        const router = useRouter()
        const error = ref(null)

        onMounted(async () => {
            const response = await axios.get(`/categories/${params.id}`)
            const category = response.data
            name.value = category.name
        })

        const submit = async () => {
            try {
                const response = await axios.put(`/categories/${params.id}`, {
                    name: name.value
                })
                name.value = ''
                await router.push({name: 'Category'})
            } catch (e) {
                error.value = e.response.data.errors
            }
        }


        return {
            name,
            error,
            submit
        }
    }
}
</script>
