<template>
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ recipe.title }}</div>
                <div class="card-body">
                    <p class="catd-text">
                        <span v-html="recipe.procedure"></span>

                    </p>
                </div>
            </div>

            <table class="table mt-3">

                <tbody>
                <tr>
                    <td><strong>id:</strong></td>
                    <td>{{recipe.id}}</td>
                </tr>

                <tr>
                    <td><strong>slug:</strong></td>
                    <td>
                        <input type="text" class="form-control" :value="recipe.slug" readonly>
                    </td>
                </tr>

                <tr>
                    <td><strong>created at:</strong></td>
                    <td>{{ formatDate(recipe.created_at) }}</td>
                </tr>

                <tr>
                    <td><strong>updated at:</strong></td>
                    <td>{{ formatDate(recipe.updated_at) }}</td>
                </tr>

                </tbody>
            </table>

            <single-edit-links resource="recipe" :id="recipe.id"></single-edit-links>
        </div>
    </div>

</template>
<script>
    import tableMxin from '../mixins/tableMixin'
    import SingleEditLinks from "../components/SingleEditLinks";
    export default {
        name: "RecipeSingle",
        components: {SingleEditLinks},
        mixins: [tableMxin],
        data() {
            return {
                recipe: {}
            }
        },

       created() {
            axios.get('/api/recipes/' + this.$route.params.id).then(response => {
                this.recipe = response.data
            })
       }

    }
</script>

<style scoped>

</style>
