<?php

namespace Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus;

/**
 * Request object for ProceedEventSchemeStatus.
 */
class ProceedEventSchemeStatusRequest
{
    private int $id;

    private string $status;

    public function __construct(
        int $id,
        string $status
    ) {
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}
