<?php

namespace Tests\Mocks\Domain\Auth\Queries;

use Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery;

class MockAuthenticateTokenQuery implements AuthenticateTokenQuery
{
    public function fetch(string $clientId, string $clientSecret, string $code, string $redirectUrl, array $scopes): string
    {
        return 'bearer-token-mock-example';
    }
}
