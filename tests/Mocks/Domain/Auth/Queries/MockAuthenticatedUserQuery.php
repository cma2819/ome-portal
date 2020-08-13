<?php

namespace Tests\Mocks\Domain\Auth\Queries;

use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Queries\AuthenticatedUserQuery;

class MockAuthenticatedUserQuery implements AuthenticatedUserQuery
{
    public function fetch(): User
    {
        return User::createRegisteredUser(1,'test user','123456789');
    }
}
