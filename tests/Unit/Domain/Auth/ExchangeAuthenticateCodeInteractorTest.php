<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery;
use Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode\ExchangeAuthenticateCodeRequest;
use Ome\Auth\UseCases\ExchangeAuthenticateCodeInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Auth\Queries\MockAuthenticateTokenQuery;

class ExchangeAuthenticateCodeInteractorTest extends TestCase
{
    protected AuthenticateTokenQuery $authenticateTokenQuery;

    protected function setUp(): void
    {
        $this->authenticateTokenQuery = new MockAuthenticateTokenQuery;
    }

    /** @test */
    public function testExchangeAuthenticateCode()
    {
        $mockBearer = $this->authenticateTokenQuery->fetch('clientId', 'clientSecret', 'code', 'redirectUrl', ['scopes']);

        $exchangeAuthenticateCode = new ExchangeAuthenticateCodeInteractor($this->authenticateTokenQuery);
        $result = $exchangeAuthenticateCode->interact(new ExchangeAuthenticateCodeRequest('clientId', 'clientSecret', 'code', 'redirectUrl'));

        $this->assertEquals($mockBearer, $result->getAccessToken());
    }

}
