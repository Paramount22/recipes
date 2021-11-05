<template>
    <div class="row">
        <div class="col-md-2 navigation">

            <the-navigation></the-navigation>
        </div>

        <main class="col-md-9">
            <the-stats></the-stats>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    import TheNavigation from "../components/TheNavigation";
    import TheStats from "../components/TheStats";
    export default {
        name: "AdminPanel",
        components: {TheStats, TheNavigation}
    }
</script>

<style lang="scss" scoped>
    .navigation {
        background: #989aa8;
        min-height: 100vh;
    }
</style>
