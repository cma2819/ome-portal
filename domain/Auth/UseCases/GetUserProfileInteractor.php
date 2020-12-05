<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery;
use Ome\Auth\Interfaces\Queries\FindUserByIdQuery;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileRequest;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileResponse;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileUseCase;
use Ome\Exceptions\EntityNotFoundException;

class GetUserProfileInteractor implements GetUserProfileUseCase
{
    protected FindUserByIdQuery $findUserById;

    protected FindDiscordByIdQuery $findDiscordById;

    public function __construct(
        FindUserByIdQuery $findUserById,
        FindDiscordByIdQuery $findDiscordById
    ) {
        $this->findUserById = $findUserById;
        $this->findDiscordById = $findDiscordById;
    }

    public function interact(GetUserProfileRequest $request): GetUserProfileResponse
    {
        $user = $this->findUserById->fetch($request->getId());

        if (is_null($user)) {
            throw new EntityNotFoundException(User::class, ['id' => $request->getId()]);
        }

        $discord = $this->findDiscordById->fetch($user->getDiscordId());

        if (is_null($discord)) {
            throw new EntityNotFoundException(DiscordUser::class, ['id' => $user->getDiscordId()]);
        }

        return new GetUserProfileResponse(
            new UserProfile(
                $user->getId(),
                $user->getUsername(),
                $discord
            )
        );
    }
}
