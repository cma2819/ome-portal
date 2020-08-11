<?php

namespace Tests\Mocks\Domain\Auth\Queries;

use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Entities\PartialDiscordUser;
use Ome\Auth\Interfaces\Queries\CurrentDiscordUserQuery;

class MockCurrentDiscordUserQuery implements CurrentDiscordUserQuery
{
    public function fetch(string $token): DiscordUser
    {
        return PartialDiscordUser::createPartial('80351110224678912', 'Nelly', '1337');
    }
}
