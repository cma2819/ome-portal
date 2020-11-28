<?php

namespace Ome\Event\Commands;

use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Commands\PersistEventSchemeCommand;

class InmemoryPersistEventScheme implements PersistEventSchemeCommand
{
    private array $schemes;

    public function __construct(
        array $schemes = []
    ) {
        $this->schemes = $schemes;
    }

    public function execute(EventScheme $eventScheme): EventScheme
    {
        if (is_null($eventScheme->getId())) {
            $id = $this->nextId();
            $registered = EventScheme::createRegistered(
                $id,
                $eventScheme->getName(),
                $eventScheme->getPlannerId(),
                $eventScheme->getStatus(),
                $eventScheme->getStartAt(),
                $eventScheme->getEndAt(),
                $eventScheme->getExplanation(),
                $eventScheme->getDetail()
            );

            $this->schemes[$id] = $registered;
            return $registered;
        }

        $this->schemes[$eventScheme->getId()] = $eventScheme;
        return $eventScheme;
    }

    private function nextId(): int
    {
        return (array_key_last($this->schemes) ?? 0) + 1;
    }

    /**
     * Get the value of schemes
     */
    public function getSchemes()
    {
        return $this->schemes;
    }
}
