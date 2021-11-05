<template>
    <section class="data-page mt-5">

        <table-search
            @searchQueryChanged="search = $event"
            resource="user"
            :count="filteredItems.length"
            :data="data.length"
        ></table-search>

        <div class="table-responsive p-3">
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
                        email
                    </th>
                    <th>
                        Register at
                    </th>

                    <th>
                        Edit/Delete
                    </th>

                </tr>
                </thead>
                <tbody>

                <tr v-for="(user, index) in filteredItems" :key="data.id">
                    <td>
                        {{index + 1}}
                    </td>
                    <td>
                        {{user.name}}
                    </td>

                    <td>
                        {{user.email}}
                    </td>

                    <td>
                        {{ formatDate(user.created_at) }}
                    </td>

                    <td>
                        <table-edit-links resource="user" :id="user.id" ></table-edit-links>

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
        name: "Users",
        mixins: [tableMxin],
        components: {TableSearch, TableEditLinks},

        data() {
            return {
                searchColumn: 'name'
            }
        },

        created() {
            axios.get('/api/users').then(response => {
                this.data = response.data
            })
        },
    }
</script>

<style scoped>

</style>
