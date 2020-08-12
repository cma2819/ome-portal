<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Commands\PersistUserCommand;
use Ome\Auth\Interfaces\Queries\FindUserByDiscordQuery;
use Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser\AuthenticateWithDiscordUserRequest;
use Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser\AuthenticateWithDiscordUserResponse;
use Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser\AuthenticateWithDiscordUserUseCase;

class AuthenticateWithDiscordUserInteractor implements AuthenticateWithDiscordUserUseCase
{
    protected FindUserByDiscordQuery $userByDiscordQuery;

    protected PersistUserCommand $persistUserCommand;

    public function __construct(
        FindUserByDiscordQuery $userByDiscordQuery,
        PersistUserCommand $persistUserCommand
    ) {
        $this->userByDiscordQuery = $userByDiscordQuery;
        $this->persistUserCommand = $persistUserCommand;
    }

    public function interact(AuthenticateWithDiscordUserRequest $request): AuthenticateWithDiscordUserResponse
    {
        $discord = $request->getDiscordUser();
        $user = $this->userByDiscordQuery->fetch($discord);
        if (is_null($user)) {
            $user = $this->persistUserCommand->execute(User::createFromDiscordUser($discord));
        }
        return new AuthenticateWithDiscordUserResponse($user);
    }
}
