<?php

namespace Ome\Twitter\Interfaces\UseCases\GetTimeline;

interface GetTimelineUseCase {

    /**
     * Get user's timeline.
     *
     * @return GetTimelineResponse
     */
    public function interact(): GetTimelineResponse;
}
