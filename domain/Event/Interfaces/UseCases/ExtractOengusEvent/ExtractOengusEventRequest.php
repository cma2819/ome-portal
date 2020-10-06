<?php

namespace Ome\Event\Interfaces\UseCases\ExtractOengusEvent;

use Carbon\Carbon;
use DateTimeInterface;

/**
 * Request object for ExtractOengusEvent.
 */
class ExtractOengusEventRequest
{
    private string $id;

    private DateTimeInterface $now;

    public function __construct(
        string $id,
        ?DateTimeInterface $now = null
    ) {
        $this->id = $id;
        if (is_null($now)) {
            $now = Carbon::now();
        }
        $this->now = $now;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of now
     */
    public function getNow()
    {
        return $this->now;
    }
}
