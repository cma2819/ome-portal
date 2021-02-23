<?php

namespace Ome\Stream\Interfaces\Queries;

use Ome\Stream\Entities\Streamer;

interface FindStreamerByIdQuery
{
    public function fetch(int $id): ?Streamer;
}
