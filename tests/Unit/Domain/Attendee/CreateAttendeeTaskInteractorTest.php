<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryPersistTaskCommand;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Interfaces\UseCases\CreateAttendeeTask\CreateAttendeeTaskRequest;
use Ome\Attendee\UseCases\CreateAttendeeTaskInteractor;
use PHPUnit\Framework\TestCase;

class CreateAttendeeTaskInteractorTest extends TestCase
{
    /** @test */
    public function testCreateAttendeeTask()
    {
        $inmemoryPersistTask = new InmemoryPersistTaskCommand();
        $createAttendeeTaskInteractor = new CreateAttendeeTaskInteractor($inmemoryPersistTask);

        $result = $createAttendeeTaskInteractor->interact(
            new CreateAttendeeTaskRequest(
                'runner',
                'Must do check your sns profiles'
            )
        );

        $expectTask = RunnerTask::createRegistered(1, 'Must do check your sns profiles');
        $this->assertEquals($expectTask, $result->getTask());
        $this->assertEquals(
            [
                1 => $expectTask
            ],
            $inmemoryPersistTask->getTasks()
        );
    }

}
