<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
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
            \Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification\SendApplySchemeNotificationUseCase::class,
            \Ome\Notification\UseCases\SendApplySchemeNotificationInteractor::class
        );

        //////////////
        // Commands //
        //////////////

        $this->app->bind(
            \Ome\Notification\Interfaces\Commands\SendNotificationCommand::class,
            \App\Infrastructure\Commands\Notification\DiscordSendNotificationCommand::class
        );

        //////////////////////////
        // Test dependencies    //
        //////////////////////////
        if (config('app.env') === 'testing') {
            $this->app->bind(
                \Ome\Notification\Interfaces\Commands\SendNotificationCommand::class,
                \Ome\Notification\Commands\InmemorySendNotification::class
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
