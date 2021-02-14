<?php

namespace Ome\Attendee\Commands;

use Ome\Attendee\Entities\TaskProgress;
use Ome\Attendee\Interfaces\Commands\PersistTaskProgressCommand;

class InmemoryPersistTaskProgressCommand implements PersistTaskProgressCommand
{
    /** @var TaskProgress[] */
    protected array $taskProgresses = [];

    public function __construct(
        array $taskProgresses = []
    ) {
        $this->taskProgresses = $taskProgresses;
    }

    public function execute(TaskProgress $taskProgress): TaskProgress
    {
        foreach ($this->taskProgresses as $index => $progress) {
            if ($taskProgress->hasSameIdentityWith($progress)) {
                $this->taskProgresses[$index] === $taskProgress;
                break;
            }
        }

        $this->taskProgresses[] = $taskProgress;

        return $taskProgress;
    }


    /**
     * Get the value of taskProgresses
     */
    public function getTaskProgresses()
    {
        return $this->taskProgresses;
    }
}
