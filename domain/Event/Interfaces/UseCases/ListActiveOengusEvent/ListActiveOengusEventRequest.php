<?php

namespace Ome\Event\Interfaces\UseCases\ListActiveOengusEvent;

use DateTimeInterface;

/**
 * Request object for ListActiveOengusEvent.
 */
class ListActiveOengusEventRequest
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
