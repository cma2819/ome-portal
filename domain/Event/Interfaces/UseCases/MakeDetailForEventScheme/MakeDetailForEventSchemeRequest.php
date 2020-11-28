<?php

namespace Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme;

/**
 * Request object for MakeDetailForEventScheme.
 */
class MakeDetailForEventSchemeRequest
{
    private int $id;

    private string $detail;

    public function __construct(
        int $id,
        string $detail
    ) {
        $this->id = $id;
        $this->detail = $detail;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of detail
     */
    public function getDetail()
    {
        return $this->detail;
    }
}
