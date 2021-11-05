<template>
    <div>
        <router-link class="btn btn-primary"  :to="`/admin/${resource}s/create`">
            Create {{resource}}
        </router-link>
        <router-link class="btn btn-outline-success"  :to="`/admin/${resource}s/${id}/edit`">
            Edit {{resource}}
        </router-link>
        <router-link class="btn btn-outline-danger"  to="">Delete {{resource}}</router-link>
    </div>
</template>

<script>
    export default {
        name: "SingleEditLinks",
        props: ['resource', 'id']
    }
</script>

<style lang="scss" scoped>

</style>
