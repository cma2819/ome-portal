<?php

namespace Ome\Attendee\Interfaces\Queries;

use Ome\Attendee\Entities\User;

interface ExtractUsersByIdQuery
{
    /**
     * @param int[] $idList
     * @return User[]
     */
    public function fetch(array $idList): array;
}
