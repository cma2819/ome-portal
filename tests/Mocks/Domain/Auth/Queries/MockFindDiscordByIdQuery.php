<?php

namespace Tests\Mocks\Domain\Auth\Queries;

use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Entities\PartialDiscordUser;
use Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery;

class MockFindDiscordByIdQuery implements FindDiscordByIdQuery
{
    public function fetch(string $id): ?DiscordUser
    {
        return PartialDiscordUser::createPartial(
            $id,
            'Nelly',
            '1234'
        );
    }
}
