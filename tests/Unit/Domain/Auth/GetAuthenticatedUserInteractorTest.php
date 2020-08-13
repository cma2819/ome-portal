<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Entities\User;
use Ome\Auth\UseCases\GetAuthenticatedUserInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Auth\Queries\MockAuthenticatedUserQuery;

class GetAuthenticatedUserInteractorTest extends TestCase
{
    /** @test */
    public function testGetAuthenticatedUser()
    {
        $mockQuery = new MockAuthenticatedUserQuery;
        $response = (new GetAuthenticatedUserInteractor($mockQuery))->interact();

        $this->assertEquals($mockQuery->fetch(), $response->getUser());
    }
}
