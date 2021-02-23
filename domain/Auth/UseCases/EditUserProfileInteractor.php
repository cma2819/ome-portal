<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Commands\PersistUserCommand;
use Ome\Auth\Interfaces\Queries\FindUserByIdQuery;
use Ome\Auth\Interfaces\UseCases\EditUserProfile\EditUserProfileRequest;
use Ome\Auth\Interfaces\UseCases\EditUserProfile\EditUserProfileResponse;
use Ome\Auth\Interfaces\UseCases\EditUserProfile\EditUserProfileUseCase;
use Ome\Exceptions\EntityNotFoundException;

class EditUserProfileInteractor implements EditUserProfileUseCase
{
    protected FindUserByIdQuery $findUserByIdQuery;

    protected PersistUserCommand $persistUserCommand;

    public function __construct(
        FindUserByIdQuery $findUserByIdQuery,
        PersistUserCommand $persistUserCommand
    ) {
        $this->findUserByIdQuery = $findUserByIdQuery;
        $this->persistUserCommand = $persistUserCommand;
    }

    public function interact(EditUserProfileRequest $request): EditUserProfileResponse
    {
        $user = $this->findUserByIdQuery->fetch($request->getId());

        if (is_null($user)) {
            throw new EntityNotFoundException(User::class, ['id' => $request->getId()]);
        }

        $user->edit($request->getUsername());

        return new EditUserProfileResponse(
            $this->persistUserCommand->execute($user)
        );
    }
}
