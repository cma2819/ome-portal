<?php

namespace Ome\Auth\Interfaces\Queries;

use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Entities\User;

interface FindUserByDiscordQuery
{
    public function fetch(DiscordUser $discord): ?User;
}
