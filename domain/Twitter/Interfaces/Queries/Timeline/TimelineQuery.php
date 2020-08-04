<?php

namespace Ome\Twitter\Interfaces\Queries\Timeline;

use Ome\Twitter\Interfaces\Dto\TweetDto;

interface TimelineQuery
{
    /**
     * Return timeline.
     *
     * @return TweetDto[]
     */
    public function fetch(): array;
}
