<?php

namespace Ome\Auth\Queries;

use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Queries\FindUserByDiscordQuery;

class InmemoryFindUserByDiscordQuery implements FindUserByDiscordQuery
{
    /** @var User[] */
    private array $users;

    /**
     * @param User[] $users
     */
    public function __construct(
        array $users = []
    ) {
        /** @var User */
        foreach ($users as $user) {
            $this->users[$user->getId()] = $user;
        }
    }

    public function fetch(DiscordUser $discord): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getDiscordId() === $discord->getId()) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Get the value of users
     */
    public function getUsers()
    {
        return $this->users;
    }
}
