<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Auth\Interfaces\Queries\AuthenticatedUserQuery;
use Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserResponse;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserUseCase;

class GetAuthenticatedUserInteractor implements GetAuthenticatedUserUseCase
{
    protected AuthenticatedUserQuery $authenticatedUserQuery;

    protected FindDiscordByIdQuery $findDiscordByIdQuery;

    public function __construct(
        AuthenticatedUserQuery $authenticatedUserQuery,
        FindDiscordByIdQuery $findDiscordByIdQuery
    ) {
        $this->authenticatedUserQuery = $authenticatedUserQuery;
        $this->findDiscordByIdQuery = $findDiscordByIdQuery;
    }

    public function interact(): GetAuthenticatedUserResponse
    {
        $user = $this->authenticatedUserQuery->fetch();
        $discord = $this->findDiscordByIdQuery->fetch($user->getDiscordId());
        return new GetAuthenticatedUserResponse(
            new UserProfile($user->getId(), $user->getUsername(), $discord)
        );
    }
}
