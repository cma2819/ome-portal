<?php

namespace Tests\Mocks\Domain\Stream\Queries;

use Ome\Stream\Entities\PartialTwitchUser;
use Ome\Stream\Entities\TwitchUser;
use Ome\Stream\Interfaces\Queries\FindTwitchUserByIdQuery;

class MockFindTwitchUserById implements FindTwitchUserByIdQuery
{
    public function fetch(string $userId, string $bearer = null): ?TwitchUser
    {
        return PartialTwitchUser::createPartial(
            $userId,
            'twitchdev',
            'TwitchDev'
        );
    }
}
