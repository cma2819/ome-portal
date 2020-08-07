<?php

namespace Ome\Twitter\Interfaces\UseCases\DeleteTweet;

/**
 * Response object for DeleteTweet.
 */
class DeleteTweetResponse
{
    private bool $result;

    public function __construct(
        bool $result
    ) {
        $this->result = $result;
    }

    /**
     * Get the value of result
     */
    public function getResult()
    {
        return $this->result;
    }
}
