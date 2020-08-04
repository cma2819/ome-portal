<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\PartialTwitterUser;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Repositories\InmemoryTweetRepository;
use Ome\Twitter\Repositories\InmemoryTwitterMediaRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Repositories
        $this->app->bind(TwitterMediaRepository::class, function (Application $app) {
            return new InmemoryTwitterMediaRepository();
        });

        $this->app->bind(TweetRepository::class, function (Application $app) {
            $now = CarbonImmutable::create(2020, 1, 1);
            $this->user = PartialTwitterUser::createPartial(1000, 'Test User', 'test_user');
            $initialTweets = [
                PartialTweet::createPartial(
                    1,
                    'test tweet 1st',
                    $this->user,
                    [],
                    $now
                ),
                PartialTweet::createPartial(
                    2,
                    'test tweet 2nd',
                    $this->user,
                    [],
                    $now->addDay(1)
                ),
                PartialTweet::createPartial(
                    3,
                    'test tweet 3rd',
                    $this->user,
                    [],
                    $now->addMonth(1)
                )
            ];
            return new InmemoryTweetRepository(
                $this->user,
                $initialTweets,
                $app->make(TwitterMediaRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
