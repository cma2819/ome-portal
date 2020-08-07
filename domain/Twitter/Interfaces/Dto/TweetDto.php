<?php

namespace Ome\Twitter\Interfaces\Dto;

use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Entities\TwitterMedia;

class TweetDto
{
    private Tweet $tweet;

    /** @var TwitterMedia[] */
    private array $medias;

    /**
     * @param Tweet $tweet
     * @param TwitterMedia[] $medias
     */
    public function __construct(
        Tweet $tweet,
        array $medias
    ) {
        $this->tweet = $tweet;
        $this->medias = $medias;
    }

    /**
     * Get the value of tweet
     */
    public function getTweet()
    {
        return $this->tweet;
    }

    /**
     * Get the value of medias
     */
    public function getMedias()
    {
        return $this->medias;
    }
}
