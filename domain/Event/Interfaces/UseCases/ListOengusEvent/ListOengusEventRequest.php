<?php

namespace Ome\Event\Interfaces\UseCases\ListOengusEvent;

use Carbon\Carbon;
use DateTimeInterface;

/**
 * Request object for ListOengusEvent.
 */
class ListOengusEventRequest
{
    private DateTimeInterface $now;

    public function __construct(
        ?DateTimeInterface $now = null
    ) {
        if (is_null($now)) {
            $now = Carbon::now();
        }

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
