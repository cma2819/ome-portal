<?php

namespace Ome\Stream\Queries;

use Ome\Stream\Entities\Streamer;
use Ome\Stream\Interfaces\Queries\FindStreamerByIdQuery;

class InmemoryFindStreamerById implements FindStreamerByIdQuery
{
    /** @var Streamer[] */
    private array $streamers;

    public function __construct(
        array $streamers = []
    ) {
        $this->streamers = $streamers;
    }

    public function fetch(int $id): ?Streamer
    {
        foreach ($this->streamers as $streamer) {
            if ($streamer->getId() === $id) {
                return $streamer;
            }
        }
        return null;
    }
}
