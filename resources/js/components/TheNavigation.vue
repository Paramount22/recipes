<template>
    <nav>
        <i class="fas fa-user-shield"></i>
        <router-link to="/admin/">Dashboard</router-link>
        <router-link to="/admin/recipes">Recipes</router-link>
        <router-link to="/admin/users">Users</router-link>
        <router-link to="/admin/categories">Categories</router-link>
        <router-link to="/admin/comments">Comments</router-link>
        <a href="/">Home</a>
        <a href="/">Logout</a>
    </nav>
</template>

<script>
    export default {
        name: "TheNavigation"
    }
</script>

<style lang="scss" scoped>
    nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 2rem;

        .fa-user-shield {
            color: white;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }

        a {
            color: #2d2e33;
            margin-bottom: 1.7rem;
            font-size: 1.5rem;
            text-decoration: none;
            transition: .2s ease all;
            &:hover {
                color: white;
            }
        }
    }


</style>
