<template>

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
                Добавить
            </button>
        </div>
    </form>


</template>

<script>
import {ref} from 'vue'

export default {
    name: 'Create',

    setup() {
        const name = ref('')

        const submit = async () => {
            console.log(name.value)
        }

        return {
            name,
            submit
        }
    }
}
</script>