<template>
    <router-link
        :to="{name: 'Category.Create'}"
        class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
    >
        Добавить
    </router-link>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    #
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Название
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Действия
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b"
                                v-for="category in categories"
                                :key="category.id"
                            >
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{category.id}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{category.name}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    <router-link
                                        :to="{name: 'Category.Edit', params: {id: category.id}}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold mx-2 py-2 px-4 rounded"
                                    >
                                        Изменить
                                    </router-link>
                                    <a
                                        href="javascript:void(0)"
                                        class="bg-red-500 hover:bg-blue-700 text-white font-bold mx-2 py-2 px-4 rounded"
                                        @click="remove(category.id)"
                                    >
                                        Удалить
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {onMounted, ref} from 'vue'
import axios from 'axios'

export default {
    name: 'Index',

    setup() {
        const categories = ref([])

        onMounted(async () => {
            try {
                const response = await axios.get('/categories')
                categories.value = response.data
            } catch (e) {
                console.log(e.response.data)
            }
        })

        const remove = async (id) => {
            if (confirm('Вы уверены, что хотите удалить эту категорию?')) {
                await axios.delete(`/categories/${id}`)
                categories.value = categories.value.filter(c => c.id !== id)
            }
        }

        return {
            categories,
            remove
        }
    }
}
</script>
