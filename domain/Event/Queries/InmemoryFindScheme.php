<?php

namespace Ome\Event\Queries;

use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Queries\FindEventSchemeQuery;

class InmemoryFindScheme implements FindEventSchemeQuery
{
    /** @var EventScheme[] */
    private array $schemes;

    public function __construct(
        array $schemes = []
    ) {
        $this->schemes = $schemes;
    }

    public function fetch(int $id): ?EventScheme
    {
        foreach ($this->schemes as $scheme) {
            if ($scheme->getId() === $id) {
                return $scheme;
            }
        }

        return null;
    }
}
