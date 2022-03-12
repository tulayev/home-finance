<template>

    <nav aria-label="alternative nav">
        <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

            <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                    <li class="mr-3 flex-1">
                        <router-link
                            :to="{name: 'Category'}"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-blue-600 border-b-2 border-gray-800 hover:border-pink-500"
                            active-class="border-blue-600 text-blue-600"
                        >
                            <i class="fas fa-tasks pr-0 md:pr-3"></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">
                                Categories
                            </span>
                        </router-link>
                    </li>
                    <li class="mr-3 flex-1">
                        <router-link
                            :to="{name: 'Record'}"
                            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-blue-600 border-b-2 border-gray-800 hover:border-pink-500"
                            active-class="border-blue-600 text-blue-600"
                        >
                            <i class="fas fa-chart-area pr-0 md:pr-3"></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">
                                History
                            </span>
                        </router-link>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

</template>

<script>
export default {
    name: 'Sidebar'
}
</script>

<style scoped>

</style>