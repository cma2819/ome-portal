<?php

namespace Tests\Mocks\Domain\Stream\Queries;

use Ome\Stream\Interfaces\Queries\GetTwitchUserIdFromAccessTokenQuery;

class MockGetTwitchUserIdFromAccessToken implements GetTwitchUserIdFromAccessTokenQuery
{
    public function fetch(string $accessToken): string
    {
        return '141981764';
    }
}
