<?php

namespace Ome\Twitter\Interfaces\UseCases\DeleteTweet;

/**
 * Request object for DeleteTweet.
 */
class DeleteTweetRequest
{
    private int $id;

    public function __construct(
        int $id
    ) {
        $this->id = $id;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}
