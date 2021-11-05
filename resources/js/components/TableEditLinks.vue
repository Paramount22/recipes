<template>
    <span>
        <router-link :to="`/admin/${resource}s/${id}/edit`">
            <i class="fas fa-pen"></i>
        </router-link>

        <a class="ml-2">
            <i class="fas fa-trash"></i>
        </a>
    </span>
</template>

<script>
    export default {
        name: "TableEditLinks",
        props: ['resource', 'id'],
    }
</script>

<style scoped>

</style>
