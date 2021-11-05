<template>
    <p>{{recipe}}</p>
</template>

<script>
    export default {
        name: "RecipeEdit",

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
