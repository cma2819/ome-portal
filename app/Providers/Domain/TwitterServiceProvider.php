<?php

namespace App\Providers\Domain;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
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
        $this->app->bind(
            \Ome\Twitter\Interfaces\UseCases\DeleteTweet\DeleteTweetUseCase::class,
            \Ome\Twitter\UseCases\DeleteTweetInteractor::class
        );

        //////////////
        // Commands //
        //////////////

        $this->app->bind(
            \Ome\Twitter\Interfaces\Commands\DeleteTweetCommand::class,
            \App\Infrastructure\Commands\Twitter\TwitterDeleteTweetCommand::class
        );
        $this->app->bind(
            \Ome\Twitter\Interfaces\Commands\PersistTweetCommand::class,
            \App\Infrastructure\Commands\Twitter\TwitterPersistTweetCommand::class
        );
        $this->app->bind(
            \Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand::class,
            \App\Infrastructure\Commands\Twitter\TwitterPersistTwitterMediaCommand::class
        );

        //////////////
        // Queries  //
        //////////////

        $this->app->bind(
            \Ome\Twitter\Interfaces\Queries\TimelineQuery::class,
            \App\Infrastructure\Queries\Twitter\TwitterTimelineQuery::class
        );

        //////////////////////////
        // Test dependencies    //
        //////////////////////////
        if (config('app.env') === 'testing') {
            // Register Store
            $this->app->singleton('InmemoryTweetStore', function (Application $app) {
                return [];
            });
            $this->app->singleton('InmemoryTwitterMediaStore', function (Application $app) {
                return [];
            });

            // Commands
            $this->app->bind(
                \Ome\Twitter\Interfaces\Commands\DeleteTweetCommand::class,
                function (Application $app) {
                    return new \Ome\Twitter\Commands\InmemoryDeleteTweet(
                        $app->make('InmemoryTweetStore')
                    );
                }
            );
            $this->app->bind(
                \Ome\Twitter\Interfaces\Commands\PersistTweetCommand::class,
                function (Application $app) {
                    return new \Ome\Twitter\Commands\InmemoryPersistTweet(
                        $app->make('InmemoryTwitterMediaStore')
                    );
                }
            );
            $this->app->bind(
                \Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand::class,
                function (Application $app) {
                    return new \Ome\Twitter\Commands\InmemoryPersistTwitterMedia(
                        $app->make('InmemoryTwitterMediaStore')
                    );
                }
            );

            // Queries
            $this->app->bind(
                \Ome\Twitter\Interfaces\Queries\TimelineQuery::class,
                function (Application $app) {
                    return new \Ome\Twitter\Queries\InmemoryTimelineQuery(
                        $app->make('InmemoryTweetStore'),
                        $app->make('InmemoryTwitterMediaStore')
                    );
                }
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
