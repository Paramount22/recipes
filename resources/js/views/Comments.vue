<template>
    <section class="data-page mt-5">
        <table-search
            @searchQueryChanged="search = $event"
            resource="comment"
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
                        Text
                    </th>
                    <th>
                        Recipe
                    </th>
                    <th>
                        User
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

                <tr v-for="(comment, index) in filteredItems" :key="data.id">
                    <td>
                        {{index + 1}}
                    </td>
                    <td>
                        {{ shorten(comment.text) }}
                    </td>

                    <td>
                        <router-link :to="'/admin/recipes/' + comment.recipe.id">
                            {{comment.recipe.id}} <strong>➱</strong>
                        </router-link>
                    </td>

                    <td>

                        <router-link :to="'/admin/users/' + comment.user.id">{{comment.user.name}}</router-link>
                    </td>

                    <td>
                        {{ formatDate(comment.created_at) }}
                    </td>
                    <td>
                        <table-edit-links resource="comment" :id="comment.id" ></table-edit-links>

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
        name: "Comments",
        mixins: [tableMxin],
        components: {TableSearch, TableEditLinks},

        data() {
            return {
                searchColumn: 'text'
            }
        },
        created() {
            axios.get('/api/comments').then(response => {
                this.data = response.data
            })
        },
    }
</script>

<style scoped>

</style>
