<?php

namespace Ome\Event\Interfaces\UseCases\GetMarathonFromOengus;

/**
 * Request object for GetMarathonFromOengus.
 */
class GetMarathonFromOengusRequest
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
