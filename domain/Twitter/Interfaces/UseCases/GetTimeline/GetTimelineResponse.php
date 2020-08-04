<?php

namespace Ome\Twitter\Interfaces\UseCases\GetTimeline;

use Ome\Twitter\Interfaces\Queries\Timeline\TweetDto;

class GetTimelineResponse
{
    /** @var TweetDto[] */
    private array $timeline;

    public function __construct(
        array $timeline
    ) {
        $this->timeline = $timeline;
    }

    /**
     * Get the value of timeline
     */
    public function getTimeline()
    {
        return $this->timeline;
    }
}
