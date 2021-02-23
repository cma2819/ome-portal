<?php

namespace Ome\Stream\Interfaces\Dto;

class TwitchAccessTokens
{
    private string $accessToken;

    /** @var string[] */
    private array $scopes;

    public function __construct(
        string $accessToken,
        array $scopes
    ) {
        $this->accessToken = $accessToken;
        $this->scopes = $scopes;
    }

    /**
     * Get the value of accessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get the value of scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }
}
