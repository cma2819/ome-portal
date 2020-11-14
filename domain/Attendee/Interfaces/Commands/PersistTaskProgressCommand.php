<?php

namespace Ome\Attendee\Interfaces\Commands;

use Ome\Attendee\Entities\TaskProgress;
use Ome\Attendee\Values\TaskScope;

interface PersistTaskProgressCommand
{
    public function execute(TaskProgress $taskProgress): TaskProgress;
}
