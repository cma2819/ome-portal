<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
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
            \Ome\Event\Interfaces\UseCases\DetachOengusMarathon\DetachOengusMarathonUseCase::class,
            \Ome\Event\UseCases\DetachOengusMarathonInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\ExtractOengusEvent\ExtractOengusEventUseCase::class,
            \Ome\Event\UseCases\ExtractOengusEventInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusUseCase::class,
            \Ome\Event\UseCases\GetMarathonFromOengusInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\ListOengusEvent\ListOengusEventUseCase::class,
            \Ome\Event\UseCases\ListOengusEventInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\SaveOengusEvent\SaveOengusEventUseCase::class,
            \Ome\Event\UseCases\SaveOengusEventInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\ListActiveOengusEvent\ListActiveOengusEventUseCase::class,
            \Ome\Event\UseCases\ListActiveOengusEventInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\FindLatestEvent\FindLatestEventUseCase::class,
            \Ome\Event\UseCases\FindLatestEventInteractor::class
        );

        //////////////
        // Commands //
        //////////////

        $this->app->bind(
            \Ome\Event\Interfaces\Commands\PersistEventCommand::class,
            \App\Infrastructure\Commands\Event\DbPersistEventCommand::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Commands\DeleteEventCommand::class,
            \App\Infrastructure\Commands\Event\DbDeleteEventCommand::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Commands\PersistAdminReplyCommand::class,
            \App\Infrastructure\Commands\Event\DbPersistAdminReplyCommand::class
        );

        //////////////
        // Queries  //
        //////////////

        $this->app->bind(
            \Ome\Event\Interfaces\Queries\FindEventQuery::class,
            \App\Infrastructure\Queries\Event\DbFindEventQuery::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Queries\OengusMarathonQuery::class,
            \App\Infrastructure\Queries\Event\ApiOengusMarathonQuery::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Queries\ListEventQuery::class,
            \App\Infrastructure\Queries\Event\DbListEventQuery::class
        );

        //////////////////////////
        // Test dependencies    //
        //////////////////////////
        if (config('app.env') === 'testing') {
            $this->app->bind(
                \Ome\Event\Interfaces\Queries\OengusMarathonQuery::class,
                \Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery\MockOengusMarathonQuery::class
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
