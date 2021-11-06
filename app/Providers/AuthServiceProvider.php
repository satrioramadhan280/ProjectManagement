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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('Admin', function($user){
            return $user->roleID == 1;
        });
        Gate::define('HDiv', function($user){
            return $user->roleID == 2;
        });
        Gate::define('HDept1', function($user){
            return $user->roleID == 3;
        });
        Gate::define('HDept2', function($user){
            return $user->roleID == 4;
        });
        Gate::define('HDept3', function($user){
            return $user->roleID == 5;
        });
        Gate::define('HDept4', function($user){
            return $user->roleID == 6;
        });
        Gate::define('MDept1', function($user){
            return $user->roleID == 7;
        });
        Gate::define('MDept2', function($user){
            return $user->roleID == 8;
        });
        Gate::define('MDept3', function($user){
            return $user->roleID == 9;
        });
        Gate::define('MDept4', function($user){
            return $user->roleID == 10;
        });
    }
}
