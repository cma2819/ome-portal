<?php

namespace Ome\Event\Interfaces\UseCases\EditEventScheme;

use Ome\Event\Entities\EventScheme;

/**
 * Response object for EditEventScheme.
 */
class EditEventSchemeResponse
{
    private EventScheme $eventScheme;

    public function __construct(
        EventScheme $scheme
    ) {
        $this->eventScheme = $scheme;
    }

    /**
     * Get the value of eventScheme
     */
    public function getEventScheme()
    {
        return $this->eventScheme;
    }
}
