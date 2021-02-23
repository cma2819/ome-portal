<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Auth\UseCases\GetAuthenticatedUserInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Auth\Queries\MockAuthenticatedUserQuery;
use Tests\Mocks\Domain\Auth\Queries\MockFindDiscordByIdQuery;

class GetAuthenticatedUserInteractorTest extends TestCase
{
    /** @test */
    public function testGetAuthenticatedUser()
    {
        $mockQuery = new MockAuthenticatedUserQuery;
        $mockDiscordQuery = new MockFindDiscordByIdQuery;
        $response = (new GetAuthenticatedUserInteractor($mockQuery, $mockDiscordQuery))->interact();

        $expectedUser = $mockQuery->fetch();
        $expectedDiscord = $mockDiscordQuery->fetch('123456789');

        $this->assertEquals(
            new UserProfile(
                $expectedUser->getId(),
                $expectedUser->getUsername(),
                $expectedDiscord
            ), $response->getUser());
    }
}
