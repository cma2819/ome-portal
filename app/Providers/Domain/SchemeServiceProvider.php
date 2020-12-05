<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;

class SchemeServiceProvider extends ServiceProvider
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
            \Ome\Event\Interfaces\UseCases\ApplyEventScheme\ApplyEventSchemeUseCase::class,
            \Ome\Event\UseCases\ApplyEventSchemeInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\EditEventScheme\EditEventSchemeUseCase::class,
            \Ome\Event\UseCases\EditEventSchemeInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\ExtractEventScheme\ExtractEventSchemeUseCase::class,
            \Ome\Event\UseCases\ExtractEventSchemeInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\FindEventScheme\FindEventSchemeUseCase::class,
            \Ome\Event\UseCases\FindEventSchemeInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme\MakeDetailForEventSchemeUseCase::class,
            \Ome\Event\UseCases\MakeDetailForEventSchemeInteractor::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusUseCase::class,
            \Ome\Event\UseCases\ProceedEventSchemeStatusInteractor::class
        );

        //////////////
        // Commands //
        //////////////
        $this->app->bind(
            \Ome\Event\Interfaces\Commands\PersistEventSchemeCommand::class,
            \App\Infrastructure\Commands\Event\DbPersistEventSchemeCommand::class
        );


        //////////////
        // Queries  //
        //////////////
        $this->app->bind(
            \Ome\Event\Interfaces\Queries\FindEventSchemeQuery::class,
            \App\Infrastructure\Queries\Event\DbFindEventSchemeQuery::class
        );
        $this->app->bind(
            \Ome\Event\Interfaces\Queries\ListEventSchemeQuery::class,
            \App\Infrastructure\Queries\Event\DbListEventSchemeQuery::class
        );

        //////////////////////////
        // Test dependencies    //
        if (config('app.env') === 'testing') {

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
