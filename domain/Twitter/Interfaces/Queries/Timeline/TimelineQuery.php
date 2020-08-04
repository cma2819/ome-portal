<?php

namespace Ome\Twitter\Interfaces\Queries\Timeline;

interface TimelineQuery
{
    /**
     * Return timeline.
     *
     * @return TweetDto[]
     */
    public function fetch(): array;
}
