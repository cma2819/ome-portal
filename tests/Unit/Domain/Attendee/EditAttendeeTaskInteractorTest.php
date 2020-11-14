<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryPersistTaskCommand;
use Ome\Attendee\Entities\CommentatorTask;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Interfaces\UseCases\EditAttendeeTask\EditAttendeeTaskRequest;
use Ome\Attendee\Queries\InmemoryFindAttendeeTaskQuery;
use Ome\Attendee\UseCases\EditAttendeeTaskInteractor;
use Ome\Attendee\Values\TaskScope;
use PHPUnit\Framework\TestCase;

class EditAttendeeTaskInteractorTest extends TestCase
{
    /** @test */
    public function testEditAttendeeTask()
    {
        $tasks = [
            RunnerTask::createRegistered(1, 'Must do check your sns profiles.'),
            CommentatorTask::createRegistered(1, 'Check runs you want to do commentary.'),
        ];

        $inmemoryFindAttendeeTask = new InmemoryFindAttendeeTaskQuery($tasks);
        $inmemoryPersistAttendeeTask = new InmemoryPersistTaskCommand($tasks);

        $interactor = new EditAttendeeTaskInteractor(
            $inmemoryFindAttendeeTask,
            $inmemoryPersistAttendeeTask,
        );

        $response = $interactor->interact(
            new EditAttendeeTaskRequest(TaskScope::runner(), 1, 'Check your sns profiles.')
        );

        $expectTask = RunnerTask::createRegistered(1, 'Check your sns profiles.');
        $this->assertEquals($expectTask, $response->getTask());
        $this->assertContainsEquals($expectTask, $inmemoryPersistAttendeeTask->getTasks());
    }

}
