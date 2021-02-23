<?php

namespace Ome\Stream\Interfaces\Queries;

use Ome\Stream\Entities\TwitchUser;

interface FindTwitchUserByIdQuery
{
    public function fetch(string $userId, string $bearer): ?TwitchUser;
}
