<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\RecipePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Recipe::class => RecipePolicy::class,
         Comment::class => CommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // check user
        Gate::define('is-user', function ($logged_in_user, $user)
        {
            return $logged_in_user->id == $user->id;
        });
        // access to ...
        Gate::define('has_access', function(User $user) {
            return $user->is_admin;
        });
    }
}
