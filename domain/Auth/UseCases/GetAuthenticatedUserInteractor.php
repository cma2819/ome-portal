<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Interfaces\Queries\AuthenticatedUserQuery;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserResponse;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserUseCase;

class GetAuthenticatedUserInteractor implements GetAuthenticatedUserUseCase
{
    protected AuthenticatedUserQuery $authenticatedUserQuery;

    public function __construct(
        AuthenticatedUserQuery $authenticatedUserQuery
    ) {
        $this->authenticatedUserQuery = $authenticatedUserQuery;
    }

    public function interact(): GetAuthenticatedUserResponse
    {
        return new GetAuthenticatedUserResponse($this->authenticatedUserQuery->fetch());
    }
}
