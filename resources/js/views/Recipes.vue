<template>
    <section class="data-page mt-5 v-cloak--hidden" v-cloak>

        <table-search
            @searchQueryChanged="search = $event"
            resource="recipe"
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
                        Title
                    </th>
                    <th>
                        Procedure
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

                <tr v-for="(recipe, index) in filteredItems" :key="data.id">
                    <td>
                        {{index + 1}}
                    </td>
                    <td>
                        <router-link :to="`/admin/recipes/${recipe.id}`">{{recipe.title}}</router-link>

                    </td>
                    <td>
                        <span v-html="shorten(recipe.procedure)"></span>

                    </td>
                     <td>
                         <router-link :to="'/admin/users/' + recipe.user.id">
                             {{recipe.user.name}}
                         </router-link>

                     </td>

                    <td>
                        {{ formatDate(recipe.created_at) }}
                    </td>
                    <td>
                        <table-edit-links resource="recipe" :id="recipe.id" ></table-edit-links>

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
        name: "Recipes",
        mixins: [tableMxin],
        components: {TableEditLinks, TableSearch},

        data() {
            return {
                searchColumn: 'title'
            }
        },

        created() {
            axios.get('/api/recipes').then(response => {
                this.data = response.data
            })
        },
    }
</script>

<style lang="scss" scoped>
    [v-cloak] .v-cloak--hidden{
        display: none;
    }

</style>
