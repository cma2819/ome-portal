<?php

namespace Ome\Event\Interfaces\UseCases\ExtractEventScheme;

use Ome\Event\Entities\EventScheme;

/**
 * Response object for ExtractEventScheme.
 */
class ExtractEventSchemeResponse
{
    /** @var EventScheme[] */
    private array $eventSchemes;

    public function __construct(
        array $eventSchemes
    ) {
        $this->eventSchemes = $eventSchemes;
    }

    /**
     * Get the value of eventSchemes
     */
    public function getEventSchemes()
    {
        return $this->eventSchemes;
    }
}
