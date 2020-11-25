<?php

namespace App\Providers;

use App\Api\Discord\DiscordApiClient;
use App\Api\Oengus\OengusApiClient;
use Clogger\Logger;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Log\Logger as IlluminateLogger;
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
                config('services.discord.bot_token'),
                config('services.discord.cache_expire')
            );
        });
        $this->app->bind(OengusApiClient::class, function (Application $app) {
            return new OengusApiClient(
                config('services.oengus.api_url'),
                config('services.oengus.cache_expire')
            );
        });
        if (!config('app.heroku_pipeline')) {
            $this->app->singleton(Logger::class, function (Application $app) {
                return new Logger($app->make(IlluminateLogger::class));
            });
        }
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
