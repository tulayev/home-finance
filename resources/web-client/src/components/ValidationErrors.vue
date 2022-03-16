<template>

    <p
        class="my-2 text-lg text-red-600"
        v-if="Array.isArray(errors)"
        v-for="e in errors"
    >
        {{e}}
    </p>
    <p
        class="my-2 text-lg text-red-600"
        v-else
    >
        {{errors}}
    </p>

</template>

<script>

export default {
    name: 'ValidationErrors',

    props: {
        errors: Object
    },
}
</script>
