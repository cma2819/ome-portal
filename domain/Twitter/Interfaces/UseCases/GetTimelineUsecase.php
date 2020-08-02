<?php

namespace Ome\Twitter\Interfaces\UseCases;

use Ome\Twitter\Entities\Tweet;

interface GetTimelineUseCase {

    /**
     * Get user's timeline.
     *
     * @return Tweet[]
     */
    public function interact(): array;
}
