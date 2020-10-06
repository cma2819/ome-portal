<?php

namespace Ome\Attendee\Commands;

use Ome\Attendee\Entities\Task;
use Ome\Attendee\Interfaces\Commands\DeleteTaskCommand;

class InmemoryDeleteTaskCommand implements DeleteTaskCommand
{
    /** @var Task[] */
    private array $tasks;

    public function __construct(
        array $tasks = []
    ) {
        $this->tasks = $tasks;
    }

    public function execute(int $id): bool
    {
        foreach ($this->tasks as $index => $task) {
            if ($task->getId() === $id) {
                unset($this->tasks[$index]);
                return true;
            }
        }

        return false;
    }

    /**
     * Get the value of tasks
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
