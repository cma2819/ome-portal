<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Interfaces\Queries\TimelineQuery;
use Ome\Twitter\Interfaces\UseCases\GetTimeline\GetTimelineResponse;
use Ome\Twitter\Interfaces\UseCases\GetTimeline\GetTimelineUseCase;

class GetTimelineInteractor implements GetTimelineUseCase
{
    protected TimelineQuery $timelineQuery;

    public function __construct(
        TimelineQuery $timelineQuery
    ) {
        $this->timelineQuery = $timelineQuery;
    }

    /**
     * Get user's timeline.
     *
     * @return Tweet[]
     */
    public function interact(): GetTimelineResponse
    {
        return new GetTimelineResponse($this->timelineQuery->fetch());
    }
}
