<?php

namespace Tests\Mocks\Domain\Stream\Queries;

use Ome\Stream\Interfaces\Dto\TwitchAccessTokens;
use Ome\Stream\Interfaces\Queries\GetAccessTokenByCodeQuery;

class MockGetAccessTokenByCode implements GetAccessTokenByCodeQuery
{
    public function fetch(string $clientId, string $clientSecret, string $code, string $redirectUri): TwitchAccessTokens
    {
        return new TwitchAccessTokens(
            '0123456789abcdefghijABCDEFGHIJ',
            ['viewing_activity_read']
        );
    }
}
