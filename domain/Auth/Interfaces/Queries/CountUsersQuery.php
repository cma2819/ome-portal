<?php

namespace Ome\Auth\Interfaces\Queries;

interface CountUsersQuery
{
    public function fetch(): int;
}
