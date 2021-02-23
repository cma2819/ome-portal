<?php

namespace Ome\Stream\Interfaces\Queries;

interface GetTwitchUserIdFromAccessTokenQuery
{
    public function fetch(string $accessToken): string;
}
