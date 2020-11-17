<?php

namespace Ome\Attendee\Interfaces\Queries;

use Ome\Attendee\Entities\User;

interface FindUserByIdQuery
{
    public function fetch(int $id): ?User;
}
