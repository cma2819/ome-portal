<?php

namespace Ome\Stream\UseCases;

use Ome\Stream\Interfaces\Queries\GetAccessTokenByCodeQuery;
use Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken\ExchangeCodeToAccessTokenRequest;
use Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken\ExchangeCodeToAccessTokenResponse;
use Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken\ExchangeCodeToAccessTokenUseCase;

class ExchangeCodeToAccessTokenInteractor implements ExchangeCodeToAccessTokenUseCase
{

    protected GetAccessTokenByCodeQuery $getAccessTokenByCodeQuery;

    public function __construct(
        GetAccessTokenByCodeQuery $getAccessTokenByCodeQuery
    ) {
        $this->getAccessTokenByCodeQuery = $getAccessTokenByCodeQuery;
    }

    public function interact(ExchangeCodeToAccessTokenRequest $request): ExchangeCodeToAccessTokenResponse
    {
        $accessTokens = $this->getAccessTokenByCodeQuery->fetch(
            $request->getClientId(),
            $request->getClientSecret(),
            $request->getCode(),
            $request->getRedirectUri()
        );

        return new ExchangeCodeToAccessTokenResponse(
            $accessTokens->getAccessToken(),
            $accessTokens->getScopes()
        );
    }
}
