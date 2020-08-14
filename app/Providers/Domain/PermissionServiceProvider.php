<?php

namespace App\Providers\Domain;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
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
            \Ome\Permission\Interfaces\UseCases\ListRolePermission\ListRolePermissionUseCase::class,
            \Ome\Permission\UseCases\ListRolePermissionInteractor::class
        );
        $this->app->bind(
            \Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionUseCase::class,
            \Ome\Permission\UseCases\SaveRolePermissionInteractor::class
        );
        $this->app->bind(
            \Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserUseCase::class,
            \Ome\Permission\UseCases\GetRolePermissionByUserInteractor::class
        );

        //////////////
        // Commands //
        //////////////

        //////////////
        // Queries  //
        //////////////
        $this->app->bind(
            \Ome\Permission\Interfaces\Queries\GetRolesForUserQuery::class,
            \App\Domain\Permission\Queries\GetDiscordRolesForUser::class
        );
        $this->app->bind(
            \Ome\Permission\Interfaces\Queries\GetPermissionForRoleQuery::class,
            \App\Domain\Permission\Queries\GetPermissionForDiscordRole::class
        );
        $this->app->bind(
            \Ome\Permission\Interfaces\Queries\ListPermissionsQuery::class,
            \App\Domain\Permission\Queries\ListPermissions::class
        );
        $this->app->bind(
            \Ome\Permission\Interfaces\Queries\ListRolesQuery::class,
            \App\Domain\Permission\Queries\ListDiscordRole::class
        );
        ;

        //////////////////////////
        // Test dependencies    //
        //////////////////////////
        if (config('app.env') === 'testing') {
            $this->app->singleton('InmemoryPermissionStore', function (Application $app) {
                return [];
            });

            $this->app->bind(
                \Ome\Permission\Interfaces\Commands\PersistRolePermissionCommand::class,
                \Ome\Permission\Commands\InmemoryPersistRolePermission::class
            );
            $this->app->bind(
                \Ome\Permission\Interfaces\Queries\ListPermissionsQuery::class,
                \Ome\Permission\Queries\InmemoryListPermissions::class
            );
            $this->app->bind(
                \Ome\Permission\Interfaces\Queries\ListRolesQuery::class,
                \Tests\Mocks\Domain\Permission\Queries\MockListRolesQuery::class
            );
            $this->app->bind(
                \Ome\Permission\Interfaces\Queries\GetPermissionForRoleQuery::class,
                function (Application $app) {
                    return new \Ome\Permission\Queries\InmemoryGetPermissionForRole($app->make('InmemoryPermissionStore'));
                }
            );
            $this->app->bind(
                \Ome\Permission\Interfaces\Queries\GetRolesForUserQuery::class,
                \Tests\Mocks\DOmain\Permission\Queries\MockGetRolesForUserQuery::class
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
