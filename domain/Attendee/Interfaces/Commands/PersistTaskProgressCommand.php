<?php

namespace Ome\Attendee\Interfaces\Commands;

use Ome\Attendee\Entities\TaskProgress;

interface PersistTaskProgressCommand
{
    public function execute(TaskProgress $taskProgress): TaskProgress;
}
