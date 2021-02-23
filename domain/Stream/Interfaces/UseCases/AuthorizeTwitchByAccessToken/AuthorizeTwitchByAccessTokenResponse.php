<?php

namespace Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken;

use Ome\Stream\Entities\TwitchUser;

/**
 * Response object for AuthorizeTwitchByAccessToken.
 */
class AuthorizeTwitchByAccessTokenResponse
{
    private TwitchUser $twitch;

    public function __construct(
        TwitchUser $twitch
    ) {
        $this->twitch = $twitch;
    }

    /**
     * Get the value of twitch
     */
    public function getTwitch()
    {
        return $this->twitch;
    }
}
