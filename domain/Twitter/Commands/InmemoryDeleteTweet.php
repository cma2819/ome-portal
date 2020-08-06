<?php

namespace Ome\Twitter\Commands;

use Ome\Twitter\Interfaces\Commands\DeleteTweetCommand;

class InmemoryDeleteTweet implements DeleteTweetCommand
{
    /** @var Tweet[] */
    private array $tweets = [];

    public function __construct(
        array $tweets = []
    ) {
        $this->tweets = $tweets;
    }

    public function execute(int $id): bool
    {
        foreach ($this->tweets as $index => $tweet) {
            if ($tweet->getId() === $id) {
                array_splice($this->tweets, $index, 1);
                return true;
            }
        }
        return false;
    }

    /**
     * Get the value of tweets
     */
    public function getTweets()
    {
        return $this->tweets;
    }
}
