<template>

    <form
        class="w-full max-w-lg mx-auto"
        @submit.prevent="submit"
    >

        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Сумма
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text"
                    v-model="amount"
                />
            </div>
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Комментарий
                </label>
                <textarea
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    v-model="comment"
                ></textarea>
            </div>
        </div>

        <div class="flex -mx-3 mb-2">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Категория
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        v-model="categoryId"
                        required
                    >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{category.name}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Тип
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        v-model="type"
                    >
                        <option value="1">Доход</option>
                        <option value="2">Расход</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="relative mt-4">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input
                type="date"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Выберите дату..."
                v-model="createdAt"
            />
        </div>

        <div class="mt-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Добавить
            </button>
        </div>
    </form>

</template>

<script>
import {onMounted, ref} from 'vue'
import axios from 'axios'
import {useRouter} from 'vue-router'

export default {
    name: 'Create',

    setup() {
        const router = useRouter()
        const amount = ref(0)
        const comment = ref('')
        const type = ref(1)
        const categories = ref([])
        const categoryId = ref(0)
        const createdAt = ref('')

        const submit = async () => {
            console.log(createdAt.value)
            try {
                await axios.post('/records', {
                    amount: amount.value,
                    comment: comment.value,
                    type: type.value,
                    category_id: categoryId.value,
                    createdAt: createdAt.value
                })

                await router.push({name: 'Record'})
            } catch (e) {
                console.log(e.response.data)
            }
        }

        onMounted(async () => {
            const response = await axios.get('/categories')
            categories.value = response.data
        })

        return {
            amount,
            comment,
            type,
            categoryId,
            createdAt,
            categories,
            submit
        }
    }
}
</script>
