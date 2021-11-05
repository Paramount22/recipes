require('./bootstrap');

import Vue from 'vue';

// router
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/admin/',
            component: () => import( /* webpackChunkName: "dashboard" */'./views/Dashboard')
        },

        {
            path: '/admin/recipes',
            component: () => import(/* webpackChunkName: "recipes" */'./views/Recipes')
        },

        {
            path: '/admin/recipes/create',
            component: () => import(/* webpackChunkName: "recipes" */'./views/RecipeCreate')
        },

        {
            path: '/admin/recipes/:id',
            component: () => import(/* webpackChunkName: "recipes" */'./views/RecipeSingle')
        },

        {
            path: '/admin/recipes/:id/edit',
            component: () => import(/* webpackChunkName: "recipes" */'./views/RecipeEdit')
        },



        {
            path: '/admin/users',
            component: () => import(/* webpackChunkName: "users" */'./views/Users')
        },
        {
            path: '/admin/categories',
            component: () => import(/* webpackChunkName: "categories" */'./views/Categories')
        },
        {
            path: '/admin/comments',
            component: () => import(/* webpackChunkName: "comments" */'./views/Comments')
        }
    ]
})
