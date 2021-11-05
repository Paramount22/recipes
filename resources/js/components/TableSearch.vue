<template>
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-3">{{resource}}s: {{count}} of {{data}} </h2>
            <input type="text"
                   class="form-control mb-3"
                   :placeholder=" 'Search ' + resource"
                   v-model="searchQuery"
            >
        </div>

        <div class="col-md-6">
            <router-link class="btn btn-outline-primary float-right" :to="`/admin/${resource}s/create`">
                New {{resource}}
            </router-link>

        </div>
    </div>
</template>

<script>
    export default {
        name: "TableSearch.vue",
        props: {
            count: {
                type: Number,
            },
            resource: {
                type: String,
            },
            data: {
                type: Number
            }
        },

        data() {
            return {
                searchQuery: ''
            }
        },
        // watcher - sleduje zmeny
        watch: {
            searchQuery(value) {
                this.$emit('searchQueryChanged', value)
            }
        }
    }
</script>

<style lang="scss" scoped>
    a {
        position: relative;
        top: 3.2rem;
    }
</style>
