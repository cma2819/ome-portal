<?php

namespace Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth;

/**
 * Response object for BuildDiscordOAuth.
 */
class BuildDiscordOAuthResponse
{
    private string $oauthUrl;

    private string $state;

    public function __construct(
        string $oauthUrl,
        string $state
    ) {
        $this->oauthUrl = $oauthUrl;
        $this->state = $state;
    }

    /**
     * Get the value of oauthUrl
     */
    public function getOauthUrl()
    {
        return $this->oauthUrl;
    }

    /**
     * Get the value of state
     */
    public function getState()
    {
        return $this->state;
    }
}
