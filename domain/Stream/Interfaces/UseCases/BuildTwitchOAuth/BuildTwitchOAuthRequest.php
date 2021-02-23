<?php

namespace Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth;

/**
 * Request object for BuildTwitchOAuth.
 */
class BuildTwitchOAuthRequest
{
    private string $clientId;

    private string $redirectUri;

    /** @var string[] */
    private array $scopes;

    /**
     * @param string $clientId
     * @param string $redirectUri
     * @param string[] $scopes
     */
    public function __construct(
        string $clientId,
        string $redirectUri,
        array $scopes
    ) {
        $this->clientId = $clientId;
        $this->redirectUri = $redirectUri;
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
     * Get the value of redirectUri
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * Get the value of scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }
}
