<?php

namespace Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser;

/**
 * Get Authenticated User.
 */
interface GetAuthenticatedUserUseCase
{
    /**
     * Get Authenticated User.
     */
    public function interact(): GetAuthenticatedUserResponse;
}
