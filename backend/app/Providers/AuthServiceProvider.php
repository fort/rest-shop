<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.


        // idk where this code is used

        $this->app['auth']->viaRequest('api-client', function ($request)
        {
          // return \App\Customer::where('email', $request->input('email'))->first();
        });
        
        $this->app['auth']->viaRequest('api-admin', function ($request)
        {
          // return \App\User::where('username', $request->input('username'))->first();
        });
    }
}
