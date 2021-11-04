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

        Gate::define('isAdmin', function($user){
            return $user->roleID == 1;
        });
        Gate::define('isHDiv', function($user){
            return $user->roleID == 2;
        });
        Gate::define('isHDept1', function($user){
            return $user->roleID == 3;
        });
        Gate::define('isHDept2', function($user){
            return $user->roleID == 4;
        });
        Gate::define('isHDept3', function($user){
            return $user->roleID == 5;
        });
        Gate::define('isHDept4', function($user){
            return $user->roleID == 6;
        });
        Gate::define('isMDept1', function($user){
            return $user->roleID == 7;
        });
        Gate::define('isMDept2', function($user){
            return $user->roleID == 8;
        });
        Gate::define('isMDept3', function($user){
            return $user->roleID == 9;
        });
        Gate::define('isMDept4', function($user){
            return $user->roleID == 10;
        });
    }
}
