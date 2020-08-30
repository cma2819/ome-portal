<?php

namespace Ome\Event\Interfaces\UseCases\DetachOengusMarathon;

/**
 * Request object for DetachOengusMarathon.
 */
class DetachOengusMarathonRequest
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
