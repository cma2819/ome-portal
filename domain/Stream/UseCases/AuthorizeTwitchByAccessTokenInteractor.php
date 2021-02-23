<?php

namespace Ome\Stream\UseCases;

use Ome\Exceptions\EntityNotFoundException;
use Ome\Stream\Entities\TwitchUser;
use Ome\Stream\Interfaces\Queries\FindTwitchUserByIdQuery;
use Ome\Stream\Interfaces\Queries\GetTwitchUserIdFromAccessTokenQuery;
use Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken\AuthorizeTwitchByAccessTokenRequest;
use Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken\AuthorizeTwitchByAccessTokenResponse;
use Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken\AuthorizeTwitchByAccessTokenUseCase;

class AuthorizeTwitchByAccessTokenInteractor implements AuthorizeTwitchByAccessTokenUseCase
{
    protected GetTwitchUserIdFromAccessTokenQuery $getTwitchUserIdFromAccessTokenQuery;

    protected FindTwitchUserByIdQuery $findTwitchUserByIdQuery;

    public function __construct(
        GetTwitchUserIdFromAccessTokenQuery $getTwitchUserIdFromAccessTokenQuery,
        FindTwitchUserByIdQuery $findTwitchUserByIdQuery
    ) {
        $this->getTwitchUserIdFromAccessTokenQuery = $getTwitchUserIdFromAccessTokenQuery;
        $this->findTwitchUserByIdQuery = $findTwitchUserByIdQuery;
    }

    public function interact(AuthorizeTwitchByAccessTokenRequest $request): AuthorizeTwitchByAccessTokenResponse
    {
        $accessToken = $request->getAccessToken();
        $twitchUserId = $this->getTwitchUserIdFromAccessTokenQuery->fetch($accessToken);
        $twitchUser = $this->findTwitchUserByIdQuery->fetch($twitchUserId, $accessToken);

        if (is_null($twitchUser)) {
            throw new EntityNotFoundException(TwitchUser::class, ['id' => $twitchUserId]);
        }

        return new AuthorizeTwitchByAccessTokenResponse($twitchUser);
    }
}
