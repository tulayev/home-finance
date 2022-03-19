<template>
    <router-link
        :to="{name: 'Record.Create'}"
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
                                    Тип
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Категория
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Дата
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Сумма
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Итого
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Комментарий
                                </th>
                                <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                    Действия
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b"
                                v-for="record in records"
                                :key="record.id"
                            >
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{type[record.type]}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{record.category.name}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{record.created_at}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{numberWithSpaces(Number(record.amount))}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{numberWithSpaces(Number(record.total))}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    {{record.comment}}
                                </td>
                                <td class="text-gray-900 px-6 py-4 whitespace-nowrap">
                                    <router-link
                                        :to="{name: 'Record.Edit', params: {id: record.id}}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold mx-2 py-2 px-4 rounded"
                                    >
                                        Изменить
                                    </router-link>
                                    <a
                                        href="javascript:void(0)"
                                        class="bg-red-500 hover:bg-blue-700 text-white font-bold mx-2 py-2 px-4 rounded"
                                        @click="remove(record.id)"
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
import {ref, onMounted} from 'vue'
import axios from 'axios'

export default {
    name: 'Index',

    setup() {
        const records = ref([])
        const type = ref({
            '1': 'Доход',
            '2': 'Расход'
        })

        onMounted(async () => {
            const response = await axios.get('/records')
            records.value = response.data
        })

        const numberWithSpaces = (x) => {
            let parts = x.toString().split('.')
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ' ')
            return parts.join('.')
        }

        const remove = async (id) => {
            if (confirm('Вы уверены, что хотите удалить эту запись?')) {
                await axios.delete(`/records/${id}`)
                records.value = records.value.filter(r => r.id !== id)
            }
        }

        return {
            records,
            type,
            numberWithSpaces,
            remove
        }
    }
}
</script>

<style scoped>

</style>
