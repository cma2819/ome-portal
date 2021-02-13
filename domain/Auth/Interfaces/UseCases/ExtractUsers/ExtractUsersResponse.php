<?php

namespace Ome\Auth\Interfaces\UseCases\ExtractUsers;

use Ome\Auth\Entities\User;

/**
 * Response object for ExtractUsers.
 */
class ExtractUsersResponse
{
    private bool $hasNext;

    /** @var User[] */
    private array $users;

    public function __construct(
        bool $hasNext,
        array $users
    ) {
        $this->hasNext = $hasNext;
        $this->users = $users;
    }

    /**
     * Get the value of users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Get the value of hasNext
     */
    public function getHasNext()
    {
        return $this->hasNext;
    }
}
