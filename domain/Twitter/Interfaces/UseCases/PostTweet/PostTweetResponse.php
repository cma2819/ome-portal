<?php

namespace Ome\Twitter\Interfaces\UseCases\PostTweet;

use Ome\Twitter\Entities\Tweet;

class PostTweetResponse
{
    private Tweet $tweet;

    public function __construct(
        Tweet $tweet
    )
    {
        $this->tweet = $tweet;
    }

    /**
     * Get the value of tweet
     */
    public function getTweet()
    {
        return $this->tweet;
    }
}