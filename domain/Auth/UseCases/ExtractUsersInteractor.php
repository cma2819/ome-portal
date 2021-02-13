<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Interfaces\Queries\CountUsersQuery;
use Ome\Auth\Interfaces\Queries\ListUsersQuery;
use Ome\Auth\Interfaces\UseCases\ExtractUsers\ExtractUsersRequest;
use Ome\Auth\Interfaces\UseCases\ExtractUsers\ExtractUsersResponse;
use Ome\Auth\Interfaces\UseCases\ExtractUsers\ExtractUsersUseCase;

class ExtractUsersInteractor implements ExtractUsersUseCase
{
    protected ListUsersQuery $listUsersQuery;

    protected CountUsersQuery $countUsersQuery;

    public function __construct(
        ListUsersQuery $listUsersQuery,
        CountUsersQuery $countUsersQuery
    ) {
        $this->listUsersQuery = $listUsersQuery;
        $this->countUsersQuery = $countUsersQuery;
    }

    public function interact(ExtractUsersRequest $request): ExtractUsersResponse
    {
        $count = $this->countUsersQuery->fetch();
        $users = $this->listUsersQuery->fetch($request->getPage());

        $hasNext = ($count > 100 * ($request->getPage() + 1));

        return new ExtractUsersResponse($hasNext, $users);
    }
}
