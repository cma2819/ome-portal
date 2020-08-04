<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Interfaces\UseCases\GetTimelineUseCase;
use Ome\Twitter\Interfaces\UseCases\PostTweetUseCase;
use Ome\Twitter\Interfaces\UseCases\UploadMediaUseCase;
use Ome\Twitter\UseCases\GetTimelineInteractor;
use Ome\Twitter\UseCases\PostTweetInteractor;
use Ome\Twitter\UseCases\UploadMediaInteractor;

class UseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GetTimelineUseCase::class, function (Application $app) {
            return new GetTimelineInteractor(
                $app->make(TweetRepository::class)
            );
        });
        $this->app->bind(PostTweetUseCase::class, function (Application $app) {
            return new PostTweetInteractor(
                $app->make(TweetRepository::class)
            );
        });
        $this->app->bind(UploadMediaUseCase::class, function (Application $app) {
            return new UploadMediaInteractor(
                $app->make(TwitterMediaRepository::class)
            );
        });
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
