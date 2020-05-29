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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('adminonly', function($user) {
            return $user->admin===1;
        });

        Gate::define('warehouse', function($user) {
            return $user->admin===2  || $user->admin===1;
        });

        Gate::define('accounting', function($user) {
            return $user->admin===3 || $user->admin===1;
        });

        //
    }
}
