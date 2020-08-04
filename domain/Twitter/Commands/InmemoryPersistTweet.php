<?php

namespace Ome\Twitter\Commands;

use Carbon\Carbon;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Interfaces\Commands\PersistTweet\PersistTweetCommand;
use Ome\Twitter\Interfaces\Commands\PersistTweet\PersistTweetFeedback;
use Ome\Twitter\Interfaces\Commands\PersistTweet\PersistTweetInput;

class InmemoryPersistTweet implements PersistTweetCommand
{
    protected array $tweets = [];

    public function execute(PersistTweetInput $input): PersistTweetFeedback
    {
        $now = Carbon::now();

        $nextId = $this->nextId();
        $tweet = PartialTweet::createPartial(
            $nextId,
            $input->getTweet()->getText(),
            $input->getTweet()->getMediaIds(),
            $now
        );
        $this->tweets[$nextId] = $tweet;
        return new PersistTweetFeedback($tweet);
    }

    public function nextId(): int
    {
        return (array_key_last($this->tweets) ?? 0) + 1;
    }

    /**
     * Get the value of tweets
     */
    public function getTweets()
    {
        return $this->tweets;
    }
}
