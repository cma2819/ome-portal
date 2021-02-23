<?php

namespace Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken;

/**
 * Request object for ExchangeCodeToAccessToken.
 */
class ExchangeCodeToAccessTokenRequest
{
    private string $clientId;

    private string $clientSecret;

    private string $code;

    private string $redirectUri;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $code,
        string $redirectUri
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->code = $code;
        $this->redirectUri = $redirectUri;
    }

    /**
     * Get the value of clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Get the value of clientSecret
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the value of redirectUri
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }
}
