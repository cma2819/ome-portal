<?php

namespace Ome\Event\Interfaces\UseCases\FindLatestEvent;

use DateTimeInterface;

/**
 * Request object for FindLatestEvent.
 */
class FindLatestEventRequest
{
    private DateTimeInterface $now;

    public function __construct(
        DateTimeInterface $now
    ) {
        $this->now = $now;
    }

    /**
     * Get the value of now
     */
    public function getNow()
    {
        return $this->now;
    }
}
