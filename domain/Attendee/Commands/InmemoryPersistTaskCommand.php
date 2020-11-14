<?php

namespace Ome\Attendee\Commands;

use Ome\Attendee\Entities\CommentatorTask;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Entities\Task;
use Ome\Attendee\Entities\VolunteerTask;
use Ome\Attendee\Interfaces\Commands\PersistTaskCommand;
use Ome\Attendee\Values\TaskScope;

class InmemoryPersistTaskCommand implements PersistTaskCommand
{
    protected array $tasks;

    public function __construct(
        array $tasks = []
    ) {
        $this->tasks = $tasks;
    }

    public function execute(Task $task): Task
    {

        if (is_null($task->getId())) {

            switch ($task->getScope()) {
                case TaskScope::runner()->value():
                    $taskClass = RunnerTask::class;
                    break;
                case TaskScope::commentator()->value():
                    $taskClass = CommentatorTask::class;
                    break;
                case TaskScope::volunteer()->value():
                    $taskClass = VolunteerTask::class;
                    break;
            }

            $newTask = call_user_func($taskClass . '::createRegistered', $this->nextId(), $task->getContent());
            $this->tasks[$newTask->getId()] = $newTask;

            return $newTask;
        }

        $this->tasks[$task->getId()] = $task;

        return $this->tasks[$task->getId()];
    }

    protected function nextId(): int
    {
        return (array_key_last($this->tasks) ?? 0) + 1;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
}
