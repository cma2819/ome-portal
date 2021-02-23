<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;

class OAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //////////
        // misc //
        //////////

        $this->app->bind(
            \Ome\OAuth\Interfaces\OAuthStateGenerator::class,
            \Ome\OAuth\OAuthStateRandomGenerator::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
