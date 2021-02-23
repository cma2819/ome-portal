<?php

namespace Tests\Unit\Domain\Stream;

use Ome\Stream\Entities\PartialTwitchUser;
use Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken\AuthorizeTwitchByAccessTokenRequest;
use Ome\Stream\UseCases\AuthorizeTwitchByAccessTokenInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Stream\Queries\MockFindTwitchUserById;
use Tests\Mocks\Domain\Stream\Queries\MockGetTwitchUserIdFromAccessToken;

class AuthorizeTwitchByAccessTokenInteractorTest extends TestCase
{
    /** @test */
    public function testAuthorizeTwitchByAccessToken()
    {
        $mockGetTwitchUserIdFromAccessToken = new MockGetTwitchUserIdFromAccessToken;
        $mockFindTwitchUserById = new MockFindTwitchUserById;

        $interactor = new AuthorizeTwitchByAccessTokenInteractor(
            $mockGetTwitchUserIdFromAccessToken,
            $mockFindTwitchUserById
        );

        $result = $interactor->interact(
            new AuthorizeTwitchByAccessTokenRequest('0123456789abcdefghijABCDEFGHIJ')
        );

        $this->assertEquals(
            PartialTwitchUser::createPartial(
                '141981764',
                'twitchdev',
                'TwitchDev'
            ),
            $result->getTwitch()
        );
    }
}
