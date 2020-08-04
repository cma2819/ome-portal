<?php

namespace Ome\Twitter\Commands;

use Carbon\Carbon;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTweetCommand;
use Ome\Twitter\Interfaces\Dto\TweetDto;

class InmemoryPersistTweet implements PersistTweetCommand
{
    /** @var TwitterMedia[] */
    protected array $twitterMedias = [];

    /** @var Tweet[] */
    protected array $tweets = [];

    public function __construct(
        array $medias = []
    ) {
        $this->twitterMedias = $medias;
    }

    public function execute(Tweet $input): TweetDto
    {
        $now = Carbon::now();

        $nextId = $this->nextId();
        $tweet = PartialTweet::createPartial(
            $nextId,
            $input->getText(),
            $input->getMediaIds(),
            $now
        );
        $this->tweets[$nextId] = $tweet;
        $medias = [];
        foreach ($tweet->getMediaIds() as $mediaId) {
            foreach ($this->twitterMedias as $media) {
                if ($media->getId() === $mediaId) {
                    $medias[] = $media;
                    continue;
                }
            }
        }
        return new TweetDto(
            $tweet,
            $medias,
        );
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
