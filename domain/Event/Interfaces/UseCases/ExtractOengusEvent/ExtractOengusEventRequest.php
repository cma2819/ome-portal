<?php

namespace Ome\Event\Interfaces\UseCases\ExtractOengusEvent;

/**
 * Request object for ExtractOengusEvent.
 */
class ExtractOengusEventRequest
{
    private string $id;

    public function __construct(
        string $id
    ) {
        $this->id = $id;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}
