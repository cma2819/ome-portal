<?php

namespace Ome\Auth\Commands;

use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Commands\PersistUserCommand;

class InmemoryPersistUserCommand implements PersistUserCommand
{
    private array $users = [];

    /**
     * @param User[] $users
     */
    public function __construct(array $users = [])
    {
        /** @var User */
        foreach ($users as $user) {
            $this->users[$user->getId()] = $user;
        }
    }

    public function execute(User $user): User
    {
        if (!is_null($user->getId())) {
            $this->users[$user->getId()] = $user;
            return $user;
        }

        $newUser = User::createRegisteredUser(
            $this->nextId(),
            $user->getUsername(),
            $user->getDiscordId(),
            $user->getTwitchIds()
        );
        $this->users[$newUser->getId()] = $newUser;
        return $newUser;
    }

    public function nextId(): int
    {
        return (array_key_last($this->users) ?? 0) + 1;
    }

    /**
     * Get the value of users
     */
    public function getUsers()
    {
        return $this->users;
    }
}
