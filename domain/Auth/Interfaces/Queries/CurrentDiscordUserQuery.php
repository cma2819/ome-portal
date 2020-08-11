<?php

namespace Ome\Auth\Interfaces\Queries;

use Ome\Auth\Entities\DiscordUser;

interface CurrentDiscordUserQuery
{
    public function fetch(string $token): DiscordUser;
}
