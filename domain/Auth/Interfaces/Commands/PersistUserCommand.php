<?php

namespace Ome\Auth\Interfaces\Commands;

use Ome\Auth\Entities\User;

interface PersistUserCommand
{
    public function execute(User $user): User;
}
