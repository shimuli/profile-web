<?php

namespace App\Providers;

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
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\ArticleModel'=> 'App\Policies\ArticleModelPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-article', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        // Gate::define('delete-article', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability,['update', 'delete'])) {
                return true;
            }
        });

    }
}
