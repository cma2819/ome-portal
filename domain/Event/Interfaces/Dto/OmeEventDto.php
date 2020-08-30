<?php

namespace Ome\Event\Interfaces\Dto;

use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;

class OmeEventDto
{
    private string $id;

    private RelateType $relateType;

    private Slug $slug;

    public function __construct(
        string $id,
        RelateType $relateType,
        Slug $slug
    ) {
        $this->id = $id;
        $this->relateType = $relateType;
        $this->slug = $slug;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of relateType
     */
    public function getRelateType()
    {
        return $this->relateType;
    }

    /**
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
