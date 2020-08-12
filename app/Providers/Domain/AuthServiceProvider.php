<?php

namespace App\Providers\Domain;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //////////////
        // UseCases //
        //////////////

        $this->app->bind(
            \Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser\AuthenticateWithDiscordUserUseCase::class,
            \Ome\Auth\UseCases\AuthenticateWithDiscordUserInteractor::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase::class,
            \Ome\Auth\UseCases\BuildDiscordOAuthInteractor::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode\ExchangeAuthenticateCodeUseCase::class,
            \Ome\Auth\UseCases\ExchangeAuthenticateCodeInteractor::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserUseCase::class,
            \Ome\Auth\UseCases\GetCurrentDiscordUserInteractor::class
        );

        //////////////
        // Commands //
        //////////////

        //////////////
        // Queries  //
        //////////////

        $this->app->bind(
            \Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery::class,
            \App\Domain\Auth\Queries\DiscordAuthenticateTokenQuery::class
        );

        //////////
        // misc //
        //////////

        $this->app->bind(
            \Ome\Auth\Interfaces\OAuthStateGenerator::class,
            \Ome\Auth\UseCases\OAuthStateRandomGenerator::class
        );

        //////////////////////////
        // Test dependencies    //
        //////////////////////////
        if (config('app.env') === 'testing') {

            // Stores
            $this->app->bind('InmemoryUserStore', function (Application $app) {
                return [];
            });

            // Commands
            $this->app->bind(
                \Ome\Auth\Interfaces\Commands\PersistUserCommand::class,
                function (Application $app) {
                    return new \Ome\Auth\Commands\InmemoryPersistUserCommand(
                        $app->make('InmemoryUserStore')
                    );
                }
            );

            // Queries
            $this->app->bind(
                \Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery::class,
                \Tests\Mocks\Domain\Auth\Queries\MockAuthenticateTokenQuery::class
            );
            $this->app->bind(
                \Ome\Auth\Interfaces\Queries\CurrentDiscordUserQuery::class,
                \Tests\Mocks\Domain\Auth\Queries\MockCurrentDiscordUserQuery::class
            );
            $this->app->bind(
                \Ome\Auth\Interfaces\Queries\FindUserByDiscordQuery::class,
                \Ome\Auth\Queries\InmemoryFindUserByDiscordQuery::class
            );
        }
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
