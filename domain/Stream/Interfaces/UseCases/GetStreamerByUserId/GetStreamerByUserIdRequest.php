<?php

namespace Ome\Stream\Interfaces\UseCases\GetStreamerByUserId;

/**
 * Request object for GetStreamerByUserId.
 */
class GetStreamerByUserIdRequest
{
    private int $userId;

    public function __construct(
        int $userId
    ) {
        $this->userId = $userId;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
