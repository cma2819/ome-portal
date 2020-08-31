<?php

namespace Ome\Event\Interfaces\UseCases\DetachOengusMarathon;

/**
 * Response object for DetachOengusMarathon.
 */
class DetachOengusMarathonResponse
{
    private bool $result;

    public function __construct(
        bool $result
    ) {
        $this->result = $result;
    }

    /**
     * Get the value of result
     */
    public function getResult()
    {
        return $this->result;
    }
}
