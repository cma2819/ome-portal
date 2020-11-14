<?php

namespace Ome\Attendee\Interfaces\Queries;

use Ome\Attendee\Entities\Task;
use Ome\Attendee\Values\TaskScope;

interface FindAttendeeTaskQuery
{
    public function fetch(TaskScope $taskScope, int $id): ?Task;
}
