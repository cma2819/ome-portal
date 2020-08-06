<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // UseCases
        $this->app->bind(
            \Ome\Twitter\Interfaces\UseCases\GetTimeline\GetTimelineUseCase::class,
            \Ome\Twitter\UseCases\GetTimelineInteractor::class
        );
        $this->app->bind(
            \Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetUseCase::class,
            \Ome\Twitter\UseCases\PostTweetInteractor::class
        );
        $this->app->bind(
            \Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaUseCase::class,
            \Ome\Twitter\UseCases\UploadMediaInteractor::class
        );

        // Commands
        $this->app->bind(
            \Ome\Twitter\Interfaces\Commands\DeleteTweetCommand::class,
            \App\Domain\Twitter\Commands\DeleteTweet::class
        );

        // Queries
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
