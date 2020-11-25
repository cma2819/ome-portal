<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Application;

/**
 * @property-read Application $app
 */
trait UseNoRoleUser
{
    protected function useNoRoleUser(): void
    {
        $this->app->bind(
            \Ome\Permission\Interfaces\Queries\GetRolesForUserQuery::class,
            \Tests\Mocks\Domain\Permission\Queries\MockGetRolesForNoAuthUserQuery::class
        );
    }
}
