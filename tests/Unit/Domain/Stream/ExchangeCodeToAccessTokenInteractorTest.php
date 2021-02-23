<?php

namespace Tests\Unit\Domain\Stream;

use Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken\ExchangeCodeToAccessTokenRequest;
use Ome\Stream\UseCases\ExchangeCodeToAccessTokenInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Stream\Queries\MockGetAccessTokenByCode;

class ExchangeCodeToAccessTokenInteractorTest extends TestCase
{
    /** @test */
    public function testExchangeCodeToAccess()
    {
        $mockGetAccessToken = new MockGetAccessTokenByCode;

        $interactor = new ExchangeCodeToAccessTokenInteractor($mockGetAccessToken);
        $result = $interactor->interact(
            new ExchangeCodeToAccessTokenRequest(
                'clientId',
                'clientSecret',
                'code',
                'http://example.com/redirect'
            )
        );

        $this->assertEquals(
            '0123456789abcdefghijABCDEFGHIJ',
            $result->getAccessToken()
        );
        $this->assertEquals(
            ['viewing_activity_read'],
            $result->getScopes()
        );
    }

}
