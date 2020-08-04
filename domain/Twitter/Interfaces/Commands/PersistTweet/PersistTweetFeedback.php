<?php

namespace Ome\Twitter\Interfaces\Commands\PersistTweet;

use Ome\Twitter\Interfaces\Dto\TweetDto;

class PersistTweetFeedback
{
    private TweetDto $tweet;

    public function __construct(
        TweetDto $tweet
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
