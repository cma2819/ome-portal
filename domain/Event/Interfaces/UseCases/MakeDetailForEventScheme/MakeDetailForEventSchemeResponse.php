<?php

namespace Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme;

use Ome\Event\Entities\EventScheme;

/**
 * Response object for MakeDetailForEventScheme.
 */
class MakeDetailForEventSchemeResponse
{
    private EventScheme $eventScheme;

    public function __construct(
        EventScheme $eventScheme
    ) {
        $this->eventScheme = $eventScheme;
    }

    /**
     * Get the value of eventScheme
     */
    public function getEventScheme()
    {
        return $this->eventScheme;
    }
}
