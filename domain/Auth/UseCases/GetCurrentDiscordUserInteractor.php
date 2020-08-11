<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Interfaces\Queries\CurrentDiscordUserQuery;
use Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserRequest;
use Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserResponse;
use Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserUseCase;

class GetCurrentDiscordUserInteractor implements GetCurrentDiscordUserUseCase
{
    protected CurrentDiscordUserQuery $currentDiscordUserQuery;

    public function __construct(
        CurrentDiscordUserQuery $currentDiscordUserQuery
    ) {
        $this->currentDiscordUserQuery = $currentDiscordUserQuery;
    }

    public function interact(GetCurrentDiscordUserRequest $request): GetCurrentDiscordUserResponse
    {
        return new GetCurrentDiscordUserResponse(
            $this->currentDiscordUserQuery->fetch($request->getToken())
        );
    }
}
