<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryDeleteTaskCommand;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask\DeleteAttendeeTaskRequest;
use Ome\Attendee\UseCases\DeleteAttendeeTaskInteractor;
use PHPUnit\Framework\TestCase;

class DeleteAttendeeTaskInteractorTest extends TestCase
{
    /** @test */
    public function testDeleteAttendeeTask()
    {
        $inmemoryDeleteTask = new InmemoryDeleteTaskCommand([
            RunnerTask::createRegistered(1, 'Must do check your sns profiles')
        ]);
        $deleteAttendeeTaskInteractor = new DeleteAttendeeTaskInteractor($inmemoryDeleteTask);

        $response = $deleteAttendeeTaskInteractor->interact(
            new DeleteAttendeeTaskRequest(1)
        );

        $this->assertTrue($response->getResult());
        $this->assertEmpty($inmemoryDeleteTask->getTasks());
    }

}
