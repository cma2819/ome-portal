<?php

namespace Ome\Event\Interfaces\UseCases\FindEventScheme;

use Ome\Event\Entities\EventScheme;

/**
 * Response object for FindEventScheme.
 */
class FindEventSchemeResponse
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
