<?php

namespace Ome\Attendee\Queries;

use Ome\Attendee\Entities\Task;
use Ome\Attendee\Interfaces\Queries\FindAttendeeTaskQuery;
use Ome\Attendee\Values\TaskScope;

class InmemoryFindAttendeeTaskQuery implements FindAttendeeTaskQuery
{
    /** @var Task[] */
    private array $tasks;

    public function __construct(
        array $tasks
    ) {
        $this->tasks = $tasks;
    }

    public function fetch(TaskScope $taskScope, int $id): ?Task
    {
        foreach ($this->tasks as $task) {
            if (
                TaskScope::createFromValue($task->getScope())->equalsTo($taskScope)
                && $task->getId() === $id
            ) {
                return $task;
            }
        }

        return null;
    }
}
