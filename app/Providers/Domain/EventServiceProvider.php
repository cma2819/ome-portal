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

        //////////////
        // Commands //
        //////////////

        $this->app->bind(
            \Ome\Event\Interfaces\Commands\PersistEventCommand::class,
            \App\Domain\Event\Commands\PersistEvent::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Commands\DeleteEventCommand::class,
            \App\Domain\Event\Commands\DeleteEvent::class
        );

        //////////////
        // Queries  //
        //////////////

        $this->app->bind(
            \Ome\Event\Interfaces\Queries\FindEventQuery::class,
            \App\Domain\Event\Queries\FindEvent::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Queries\OengusMarathonQuery::class,
            \App\Domain\Event\Queries\OengusMarathon::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Queries\ListEventQuery::class,
            \App\Domain\Event\Queries\ListEvent::class
        );

        //////////////////////////
        // Test dependencies    //
        //////////////////////////
        if (config('app.env') === 'testing') {

            $this->app->bind(
                \Ome\Event\Interfaces\Queries\OengusMarathonQuery::class,
                \Tests\Mocks\DOmain\Event\Queries\MockOengusMarathonQuery::class
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
