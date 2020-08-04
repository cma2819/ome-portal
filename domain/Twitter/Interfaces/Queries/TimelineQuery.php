<?php

namespace Ome\Twitter\Interfaces\Queries;

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
