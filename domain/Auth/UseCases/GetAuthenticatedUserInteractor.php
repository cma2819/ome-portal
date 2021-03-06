<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Auth\Interfaces\Queries\AuthenticatedUserQuery;
use Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserResponse;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserUseCase;
use Ome\Exceptions\EntityNotFoundException;

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
        if (is_null($discord)) {
            throw new EntityNotFoundException(DiscordUser::class, ['id' => $user->getDiscordId()]);
        }
        return new GetAuthenticatedUserResponse(
            new UserProfile($user->getId(), $user->getUsername(), $discord)
        );
    }
}
