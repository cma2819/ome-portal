<?php

namespace Ome\Auth\Interfaces\Queries;

use Ome\Auth\Entities\DiscordUser;

interface FindDiscordByIdQuery
{
    public function fetch(string $id): ?DiscordUser;
}
