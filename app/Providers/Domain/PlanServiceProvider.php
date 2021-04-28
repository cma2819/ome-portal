<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;

class PlanServiceProvider extends ServiceProvider
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
            \Ome\Event\Interfaces\UseCases\ApplyEventPlan\ApplyEventPlanUseCase::class,
            \Ome\Event\UseCases\ApplyEventPlanInteractor::class
        );

        $this->app->bind(
            \Ome\Event\Interfaces\UseCases\ExtractEventPlan\ExtractEventPlanUseCase::class,
            \Ome\Event\UseCases\ExtractEventPlanInteractor::class
        );

        //////////////
        // Commands //
        //////////////
        $this->app->bind(
            \Ome\Event\Interfaces\Commands\PersistEventPlanCommand::class,
            \App\Infrastructure\Commands\Event\DbPersistEventPlanCommand::class
        );

        //////////////
        // Queries  //
        //////////////
        $this->app->bind(
            \Ome\Event\Interfaces\Queries\ListEventPlanQuery::class,
            \App\Infrastructure\Queries\Event\DbListEventPlanQuery::class
        );

        //////////////////////////
        // Test dependencies    //
        //////////////////////////
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
