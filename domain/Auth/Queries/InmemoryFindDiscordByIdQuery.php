<?php

namespace Ome\Auth\Queries;

use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery;

class InmemoryFindDiscordByIdQuery implements FindDiscordByIdQuery
{
    /** @var DiscordUser[] */
    private array $discords;

    public function __construct(
        array $discords = []
    ) {
        $this->discords = $discords;
    }

    public function fetch(string $id): ?DiscordUser
    {
        foreach ($this->discords as $discord) {
            if ($discord->getId() === $id) {
                return $discord;
            }
        }

        return null;
    }
}
