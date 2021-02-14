<?php

namespace Ome\Attendee\Queries;

use Ome\Attendee\Entities\User;
use Ome\Attendee\Interfaces\Queries\FindUserByIdQuery;

class InmemoryFindUserByIdQuery implements FindUserByIdQuery
{
    /** @var User[] */
    private array $users;

    public function __construct(
        array $users
    ) {
        $this->users = $users;
    }

    public function fetch(int $id): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }

        return null;
    }
}
