<?php

namespace Ome\Twitter\Queries;

use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Dto\TweetDto;
use Ome\Twitter\Interfaces\Queries\TimelineQuery;

class InmemoryTimelineQuery implements TimelineQuery
{
    /** @var Tweet[] */
    private array $tweets;

    /** @var TwitterMedia[] */
    private array $medias;

    /**
     * @param Tweet[] $tweets
     * @param TwitterMedia[] $medias
     */
    public function __construct(
        array $tweets = [],
        array $medias = []
    ) {
        $this->tweets = $tweets;
        $this->medias = $medias;
    }

    public function fetch(): array
    {
        $tweetDtoArray = [];
        foreach ($this->tweets as $tweet) {
            $tweetMedias = [];
            foreach ($tweet->getMediaIds() as $mediaId) {
                foreach ($this->medias as $media) {
                    if ($mediaId === $media->getId()) {
                        $tweetMedias[] = $media;
                    }
                }
            }
            $tweetDtoArray[] = new TweetDto($tweet, $tweetMedias);
        }
        return $tweetDtoArray;
    }
}
