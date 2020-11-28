<?php

namespace Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus;

use Ome\Event\Entities\EventScheme;

/**
 * Response object for ProceedEventSchemeStatus.
 */
class ProceedEventSchemeStatusResponse
{
    private EventScheme $scheme;

    public function __construct(
        EventScheme $scheme
    ) {
        $this->scheme = $scheme;
    }

    /**
     * Get the value of scheme
     */
    public function getScheme()
    {
        return $this->scheme;
    }
}
