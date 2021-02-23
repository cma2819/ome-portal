<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;

class StreamServiceProvider extends ServiceProvider
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
            \Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken\AuthorizeTwitchByAccessTokenUseCase::class,
            \Ome\Stream\UseCases\AuthorizeTwitchByAccessTokenInteractor::class
        );
        $this->app->bind(
            \Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthUseCase::class,
            \Ome\Stream\UseCases\BuildTwitchOAuthInteractor::class
        );
        $this->app->bind(
            \Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser\ConnectTwitchToUserUseCase::class,
            \Ome\Stream\UseCases\ConnectTwitchToUserInteractor::class
        );
        $this->app->bind(
            \Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken\ExchangeCodeToAccessTokenUseCase::class,
            \Ome\Stream\UseCases\ExchangeCodeToAccessTokenInteractor::class
        );
        $this->app->bind(
            \Ome\Stream\Interfaces\UseCases\GetStreamerByUserId\GetStreamerByUserIdUseCase::class,
            \Ome\Stream\UseCases\GetStreamerByUserIdInteractor::class
        );

        //////////////
        // Commands //
        //////////////
        $this->app->bind(
            \Ome\Stream\Interfaces\Commands\PersistStreamerCommand::class,
            \App\Infrastructure\Commands\Stream\DbPersistStreamer::class
        );

        //////////////
        // Queries  //
        //////////////
        $this->app->bind(
            \Ome\Stream\Interfaces\Queries\FindTwitchUserByIdQuery::class,
            \App\Infrastructure\Queries\Stream\ApiFindTwitchUserById::class
        );
        $this->app->bind(
            \Ome\Stream\Interfaces\Queries\GetAccessTokenByCodeQuery::class,
            \App\Infrastructure\Queries\Stream\ApiGetAccessTokenByCode::class
        );
        $this->app->bind(
            \Ome\Stream\Interfaces\Queries\GetTwitchUserIdFromAccessTokenQuery::class,
            \App\Infrastructure\Queries\Stream\ApiGetTwitchUserIdFromAccessToken::class
        );
        $this->app->bind(
            \Ome\Stream\Interfaces\Queries\FindStreamerByIdQuery::class,
            \App\Infrastructure\Queries\Stream\DbFindStreamerById::class
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
