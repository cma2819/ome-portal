<?php

namespace Ome\Event\Interfaces\UseCases\FindEventScheme;

/**
 * Request object for FindEventScheme.
 */
class FindEventSchemeRequest
{
    private int $id;

    public function __construct(
        int $id
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
