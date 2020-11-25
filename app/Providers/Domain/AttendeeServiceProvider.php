<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;

class AttendeeServiceProvider extends ServiceProvider
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
            \Ome\Attendee\Interfaces\UseCases\CreateAttendeeTask\CreateAttendeeTaskUseCase::class,
            \Ome\Attendee\UseCases\CreateAttendeeTaskInteractor::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask\DeleteAttendeeTaskUseCase::class,
            \Ome\Attendee\UseCases\DeleteAttendeeTaskInteractor::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent\DetachAttendeeFromEventUseCase::class,
            \Ome\Attendee\UseCases\DetachAttendeeFromEventInteractor::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\UseCases\EditAttendeeTask\EditAttendeeTaskUseCase::class,
            \Ome\Attendee\UseCases\EditAttendeeTaskInteractor::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventUseCase::class,
            \Ome\Attendee\UseCases\FindAttendeeInEventInteractor::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventUseCase::class,
            \Ome\Attendee\UseCases\ListAttendeesInEventInteractor::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\UseCases\ProceedAttendeeTaskStatus\ProceedAttendeeTaskStatusUseCase::class,
            \Ome\Attendee\UseCases\ProceedAttendeeTaskStatusInteractor::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventUseCase::class,
            \Ome\Attendee\UseCases\RegisterAttendeeForEventInteractor::class
        );

        //////////////
        // Commands //
        //////////////
        $this->app->bind(
            \Ome\Attendee\Interfaces\Commands\PersistAttendeeCommand::class,
            \App\Infrastructure\Commands\Attendee\DbPersistAttendeeCommand::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\Commands\DeleteAttendeeCommand::class,
            \App\Infrastructure\Commands\Attendee\DbDeleteAttendeeCommand::class
        );

        //////////////
        // Queries  //
        //////////////
        $this->app->bind(
            \Ome\Attendee\Interfaces\Queries\ExtractAttendeesQuery::class,
            \App\Infrastructure\Queries\Attendee\DbExtractAttendeesQuery::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\Queries\ExtractUsersByIdQuery::class,
            \App\Infrastructure\Queries\Attendee\DbExtractUsersByIdQuery::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\Queries\FindAttendeeQuery::class,
            \App\Infrastructure\Queries\Attendee\DbFindAttendeeQuery::class
        );
        $this->app->bind(
            \Ome\Attendee\Interfaces\Queries\FindUserByIdQuery::class,
            \App\Infrastructure\Queries\Attendee\DbFindUserByIdQuery::class
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
