<?php

namespace Ome\Twitter\Queries;

use Ome\Twitter\Interfaces\Queries\Timeline\TimelineQuery;
use Ome\Twitter\Interfaces\Queries\Timeline\TweetDto;

class InmemoryTimelineQuery implements TimelineQuery
{
    /** @var TweetDto */
    private array $tweets;

    public function __construct(
        array $tweets
    )
    {
        $this->tweets = $tweets;
    }

    public function fetch(): array
    {
        return $this->tweets;
    }
}
