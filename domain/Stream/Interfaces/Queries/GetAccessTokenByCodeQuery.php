<?php

namespace Ome\Stream\Interfaces\Queries;

use Ome\Stream\Interfaces\Dto\TwitchAccessTokens;

interface GetAccessTokenByCodeQuery
{
    public function fetch(
        string $clientId,
        string $clientSecret,
        string $code,
        string $redirectUri
    ): TwitchAccessTokens;
}
