<?php

namespace Ome\Stream\Interfaces\Commands;

use Ome\Stream\Entities\Streamer;

interface PersistStreamerCommand
{
    public function execute(Streamer $streamer): Streamer;
}
