<?php

namespace Ome\Twitter\Interfaces\Commands\PersistTweet;

use Ome\Twitter\Entities\Tweet;

class PersistTweetFeedback
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
