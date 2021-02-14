<?php

namespace Ome\Auth\Interfaces\UseCases\ExtractUsers;

/**
 * Extract Users.
 */
interface ExtractUsersUseCase
{
    /**
     * Extract Users.
     */
    public function interact(ExtractUsersRequest $request): ExtractUsersResponse;
}
