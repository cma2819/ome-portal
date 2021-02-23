<?php

namespace Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken;

/**
 * Request object for AuthorizeTwitchByAccessToken.
 */
class AuthorizeTwitchByAccessTokenRequest
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
