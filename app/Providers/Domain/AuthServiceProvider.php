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
            \Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserUseCase::class,
            \Ome\Auth\UseCases\GetAuthenticatedUserInteractor::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserUseCase::class,
            \Ome\Auth\UseCases\GetCurrentDiscordUserInteractor::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileUseCase::class,
            \Ome\Auth\UseCases\GetUserProfileInteractor::class
        );

        //////////////
        // Commands //
        //////////////

        $this->app->bind(
            \Ome\Auth\Interfaces\Commands\PersistUserCommand::class,
            \App\Infrastructure\Commands\Auth\DbPersistUserCommand::class
        );

        //////////////
        // Queries  //
        //////////////

        $this->app->bind(
            \Ome\Auth\Interfaces\Queries\AuthenticatedUserQuery::class,
            \App\Infrastructure\Queries\Auth\AppAuthenticatedUserQuery::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery::class,
            \App\Infrastructure\Queries\Auth\DiscordAuthenticateTokenQuery::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\Queries\CurrentDiscordUserQuery::class,
            \App\Infrastructure\Queries\Auth\DiscordCurrentUserQuery::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\Queries\FindUserByDiscordQuery::class,
            \App\Infrastructure\Queries\Auth\FindUserByDiscordQuery::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery::class,
            \App\Infrastructure\Queries\Auth\ApiFindDiscordByIdQuery::class
        );
        $this->app->bind(
            \Ome\Auth\Interfaces\Queries\FindUserByIdQuery::class,
            \App\Infrastructure\Queries\Auth\DbFindUserByIdQuery::class
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
            $this->app->singleton('InmemoryUserStore', function (Application $app) {
                return [];
            });

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
                \Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery::class,
                \Tests\Mocks\Domain\Auth\Queries\MockFindDiscordByIdQuery::class
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
