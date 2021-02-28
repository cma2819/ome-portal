<?php

namespace Ome\Event\Queries;

use DateTimeInterface;
use Ome\Event\Entities\OengusMarathon;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;

class InmemoryOengusMarathonQuery implements OengusMarathonQuery
{
    /** @var OengusMarathon[] */
    private array $marathons;

    /**
     * @param OengusMarathon[] $marathons
     */
    public function __construct(
        array $marathons = []
    ) {
        $this->marathons = $marathons;
    }

    public function fetch(string $id, DateTimeInterface $now): OengusMarathon
    {
        foreach ($this->marathons as $marathon) {
            if ($marathon->getId() === $id) {
                return $marathon;
            }
        }

        return null;
    }

    /**
     * Get the value of marathons
     */
    public function getMarathons()
    {
        return $this->marathons;
    }
}
