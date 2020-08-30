<?php

namespace Ome\Event\Interfaces\UseCases\GetMarathonFromOengus;

use Ome\Event\Entities\OengusMarathon;

/**
 * Response object for GetMarathonFromOengus.
 */
class GetMarathonFromOengusResponse
{
    private OengusMarathon $oengusMarathon;

    public function __construct(
        OengusMarathon $oengusMarathon
    ) {
        $this->oengusMarathon = $oengusMarathon;
    }

    /**
     * Get the value of oengusMarathon
     */
    public function getOengusMarathon()
    {
        return $this->oengusMarathon;
    }
}
