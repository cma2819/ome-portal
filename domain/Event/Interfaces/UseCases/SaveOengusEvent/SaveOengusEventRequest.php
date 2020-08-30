<?php

namespace Ome\Event\Interfaces\UseCases\SaveOengusEvent;

use Ome\Event\Entities\OengusMarathon;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;

/**
 * Request object for SaveOengusEvent.
 */
class SaveOengusEventRequest
{
    private OengusMarathon $oengusMarathon;

    private string $relateType;

    private string $slug;

    public function __construct(
        OengusMarathon $oengusMarathon,
        string $relateType,
        string $slug
    ) {
        $this->oengusMarathon = $oengusMarathon;
        $this->relateType = $relateType;
        $this->slug = $slug;
    }

    /**
     * Get the value of oengusMarathon
     */
    public function getOengusMarathon()
    {
        return $this->oengusMarathon;
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
