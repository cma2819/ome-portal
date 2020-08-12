<?php

namespace Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode;

/**
 * Request object for ExchangeAuthenticateCode.
 */
class ExchangeAuthenticateCodeRequest
{
    private string $clientId;

    private string $clientSecret;

    private string $code;

    private string $redirectUrl;

    /** @var string[] */
    private array $scopes;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $code,
        string $redirectUrl,
        array $scopes = ['identify']
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->code = $code;
        $this->redirectUrl = $redirectUrl;
        $this->scopes = $scopes;
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
     * Get the value of redirectUrl
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * Get the value of scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }
}
