<?php

namespace Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser;

use Ome\Stream\Entities\Streamer;

/**
 * Response object for ConnectTwitchToUser.
 */
class ConnectTwitchToUserResponse
{
    private Streamer $streamer;

    public function __construct(
        Streamer $streamer
    ) {
        $this->streamer = $streamer;
    }

    /**
     * Get the value of streamer
     */
    public function getStreamer()
    {
        return $this->streamer;
    }
}
