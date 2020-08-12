<?php

namespace Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth;

/**
 * Request object for BuildDiscordOAuth.
 */
class BuildDiscordOAuthRequest
{
    private string $clientId;

    private string $redirectUrl;

    /** @var string[] */
    private array $scopes;

    public function __construct(
        string $clientId,
        string $redirectUrl,
        array $scopes = ['identify']
    ) {
        $this->clientId = $clientId;
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
