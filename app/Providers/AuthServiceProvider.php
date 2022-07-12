<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
            return count(array_intersect(["0"], json_decode($user->roles)));
        });
        Gate::define('isPengajar', function($user){
            return count(array_intersect(["1"], json_decode($user->roles)));
        });
        Gate::define('isSiswa', function($user){
            return count(array_intersect(["2"], json_decode($user->roles)));
        });

        Gate::define('isPengajardanAdmin', function($user){
            return count(array_intersect(["0","1"], json_decode($user->roles)));
        });

        // Gate::define('update-user', function($user){
        //     return $user->id;
        // });



        // Gate::define('manage-users', function($user){
        //     return count(array_intersect(["0","1"], json_decode($user->roles)));
        // });

        Gate::define('manage-job-class', function($user){
            return count(array_intersect(["0","1"], json_decode($user->roles)));
        });
        Gate::define('manage-skill', function($user){
            return count(array_intersect(["0","1"], json_decode($user->roles)));
        });
        Gate::define('manage-quest', function($user){
            return count(array_intersect(["0","1"], json_decode($user->roles)));
        });
        Gate::define('manage-order-quest', function($user){
            return count(array_intersect(["0","1"], json_decode($user->roles)));
        });
    }
}
