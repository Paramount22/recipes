<template>
    <section class="data-page mt-5">
        <table-search
            @searchQueryChanged="search = $event"
            resource="categorie"
            :count="filteredItems.length"
            :data="data.length"
        ></table-search>

        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Name
                    </th>

                    <th>
                        Created
                    </th>

                    <th>
                        Edit/Delete
                    </th>

                </tr>
                </thead>
                <tbody>

                <tr v-for="(category, index) in filteredItems" :key="data.id">
                    <td>
                        {{index + 1}}
                    </td>
                    <td>
                        {{ category.name }}
                    </td>


                    <td>
                        {{ formatDate(category.created_at) }}
                    </td>
                    <td>
                        <table-edit-links resource="category" :id="category.id" ></table-edit-links>
                    </td>

                </tr>

                </tbody>
            </table>
        </div>
    </section>
</template>

<script>
    import tableMxin from '../mixins/tableMixin'
    import TableSearch from '../components/TableSearch'
    import TableEditLinks from "../components/TableEditLinks";
    export default {
        name: "Categories",
        mixins: [tableMxin],
        components: {TableSearch, TableEditLinks},

        data() {
            return {
                searchColumn: 'name'
            }
        },
        created() {
            axios.get('/api/categories').then(response => {
                this.data = response.data
            })
        },
    }
</script>

<style scoped>

</style>
