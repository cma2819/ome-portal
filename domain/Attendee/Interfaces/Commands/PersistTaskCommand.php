<?php

namespace Ome\Attendee\Interfaces\Commands;

use Ome\Attendee\Entities\Task;

interface PersistTaskCommand
{
    public function execute(Task $task): Task;
}
