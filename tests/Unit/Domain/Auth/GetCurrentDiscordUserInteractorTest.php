<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserRequest;
use Ome\Auth\UseCases\GetCurrentDiscordUserInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Auth\Queries\MockCurrentDiscordUserQuery;

class GetCurrentDiscordUserInteractorTest extends TestCase
{
    /** @test */
    public function testGetCurrentDiscordUser()
    {
        $currentDiscordUserInteractor = new GetCurrentDiscordUserInteractor(new MockCurrentDiscordUserQuery);

        $result = $currentDiscordUserInteractor->interact(
            new GetCurrentDiscordUserRequest('bearer token so long one')
        );

        $this->assertEquals(
            (new MockCurrentDiscordUserQuery)->fetch('mocking'), $result->getUser()
        );
    }
}
