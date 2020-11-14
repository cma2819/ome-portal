<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryPersistTaskProgressCommand;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Entities\RunnerTaskProgress;
use Ome\Attendee\Interfaces\UseCases\ProceedAttendeeTaskStatus\ProceedAttendeeTaskStatusRequest;
use Ome\Attendee\Queries\InmemoryFindAttendeeTaskQuery;
use Ome\Attendee\UseCases\ProceedAttendeeTaskStatusInteractor;
use Ome\Attendee\Values\ProgressStatus;
use PHPUnit\Framework\TestCase;

class ProceedAttendeeTaskProgressStatusInteractorTest extends TestCase
{
    /** @test */
    public function testProceedAttendeeTaskProgressStatus()
    {
        $targetTask = RunnerTask::createRegistered(1, 'Must do check sns profiles.');
        $inmemoryFindTask = new InmemoryFindAttendeeTaskQuery([$targetTask]);

        $targetProgress = RunnerTaskProgress::createFromTask($targetTask, 1, ProgressStatus::apply(), '');
        $inmemoryPersistTaskProgress = new InmemoryPersistTaskProgressCommand([$targetProgress]);

        $proceedAttendeeTaskProgressStatus = new ProceedAttendeeTaskStatusInteractor(
            $inmemoryFindTask,
            $inmemoryPersistTaskProgress
        );

        $exceptTaskProgress = RunnerTaskProgress::createFromTask($targetTask, 1, ProgressStatus::approval(), 'Approve from Admin.');
        $response = $proceedAttendeeTaskProgressStatus->interact(
            new ProceedAttendeeTaskStatusRequest('runner', $targetTask->getId(), 1, 'approval', 'Approve from Admin.')
        );

        $this->assertEquals($exceptTaskProgress, $response->getTaskProgress());
        $this->assertContainsEquals($exceptTaskProgress, $inmemoryPersistTaskProgress->getTaskProgresses());
    }

}
