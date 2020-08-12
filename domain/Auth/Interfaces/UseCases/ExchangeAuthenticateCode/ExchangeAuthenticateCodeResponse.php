<?php

namespace Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode;

/**
 * Response object for ExchangeAuthenticateCode.
 */
class ExchangeAuthenticateCodeResponse
{
    private string $accessToken;

    public function __construct(
        string $accessToken
    ) {
        $this->accessToken = $accessToken;
    }

    /**
     * Get the value of accessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
