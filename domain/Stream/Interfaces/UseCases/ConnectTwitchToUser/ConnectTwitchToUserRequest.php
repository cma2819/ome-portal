<?php

namespace Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser;

use Ome\Stream\Entities\TwitchUser;

/**
 * Request object for ConnectTwitchToUser.
 */
class ConnectTwitchToUserRequest
{
    private int $userId;

    private TwitchUser $twitchUser;

    public function __construct(
        int $userId,
        TwitchUser $twitchUser
    ) {
        $this->userId = $userId;
        $this->twitchUser = $twitchUser;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of twitchUser
     */
    public function getTwitchUser()
    {
        return $this->twitchUser;
    }
}
