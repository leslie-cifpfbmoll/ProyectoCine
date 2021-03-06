<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
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

        Gate::define('administrar', function($user){
           return $user->hasAnyRole('admin'); 
        });
        Gate::define('usuario', function($user,$id){
           return $user->isUser($id); 
        });
        Gate::define('loged', function(){
           $user = Auth::check();
           if($user){
               return true;}
           else{ return false;}
        });
    }
}
