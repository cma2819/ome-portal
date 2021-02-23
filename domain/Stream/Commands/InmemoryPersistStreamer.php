<?php

namespace Ome\Stream\Commands;

use Ome\Stream\Entities\Streamer;
use Ome\Stream\Interfaces\Commands\PersistStreamerCommand;

class InmemoryPersistStreamer implements PersistStreamerCommand
{
    /** @var Streamer[] */
    private array $streamers;

    /**
     * @param Streamer[] $streamers
     */
    public function __construct(array $streamers = [])
    {
        $this->streamers = $streamers;
    }

    public function execute(Streamer $streamer): Streamer
    {
        foreach ($this->streamers as $idx => $st) {
            if ($streamer->getId() === $st->getId()) {
                $this->streamers[$idx] = $streamer;
                return $streamer;
            }
        }

        $this->streamers[] = $streamer;
    }

    /**
     * Get the value of streamers
     */
    public function getStreamers()
    {
        return $this->streamers;
    }
}
