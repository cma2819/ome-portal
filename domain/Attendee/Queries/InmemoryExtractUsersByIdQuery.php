<?php

namespace Ome\Attendee\Queries;

use Ome\Attendee\Entities\User;
use Ome\Attendee\Interfaces\Queries\ExtractUsersByIdQuery;

class InmemoryExtractUsersByIdQuery implements ExtractUsersByIdQuery
{
    /** @var User[] */
    private array $users;

    public function __construct(
        array $users
    ) {
        $this->users = $users;
    }

    public function fetch(array $idList): array
    {
        $result = [];

        foreach ($this->users as $user) {
            if (in_array($user->getId(), $idList)) {
                $result[] = $user;
            }
        }

        return $result;
    }
}
