<?php

namespace App\Providers;

use App\Api\DiscordApiClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use mpyw\Cowitter\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function (Application $app) {
            return new Client([
                config('services.twitter.consumer.key'),
                config('services.twitter.consumer.secret'),
                config('services.twitter.access.token'),
                config('services.twitter.access.secret')
            ]);
        });
        $this->app->bind(DiscordApiClient::class, function (Application $app) {
            return new DiscordApiClient(
                config('services.discord.api_url'),
                config('services.discord.bot_token')
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
