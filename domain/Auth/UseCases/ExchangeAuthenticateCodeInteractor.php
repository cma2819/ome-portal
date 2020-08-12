<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery;
use Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode\ExchangeAuthenticateCodeRequest;
use Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode\ExchangeAuthenticateCodeResponse;
use Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode\ExchangeAuthenticateCodeUseCase;

class ExchangeAuthenticateCodeInteractor implements ExchangeAuthenticateCodeUseCase
{
    protected AuthenticateTokenQuery $authenticateTokenQuery;

    public function __construct(
        AuthenticateTokenQuery $authenticateTokenQuery
    ) {
        $this->authenticateTokenQuery = $authenticateTokenQuery;
    }

    public function interact(ExchangeAuthenticateCodeRequest $request): ExchangeAuthenticateCodeResponse
    {
        $bearer = $this->authenticateTokenQuery->fetch(
            $request->getClientId(),
            $request->getClientSecret(),
            $request->getCode(),
            $request->getRedirectUrl(),
            $request->getScopes()
        );

        return new ExchangeAuthenticateCodeResponse($bearer);
    }
}
