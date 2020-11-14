<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryPersistTaskProgressCommand;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Entities\RunnerTaskProgress;
use Ome\Attendee\Interfaces\UseCases\ApplyAttendeeTask\ApplyAttendeeTaskRequest;
use Ome\Attendee\Queries\InmemoryFindAttendeeTaskQuery;
use Ome\Attendee\UseCases\ApplyAttendeeTaskInteractor;
use Ome\Attendee\Values\ProgressStatus;
use PHPUnit\Framework\TestCase;

class ApplyAttendeeTaskInteractorTest extends TestCase
{
    /** @test */
    public function testApplyAttendeeTask()
    {
        $targetTask = RunnerTask::createRegistered(1, 'Must do check sns profiles.');
        $inmemoryFindTask = new InmemoryFindAttendeeTaskQuery([$targetTask]);

        $inmemoryPersistTaskProgress = new InmemoryPersistTaskProgressCommand();

        $applyAttendeeTaskInteractor = new ApplyAttendeeTaskInteractor(
            $inmemoryFindTask,
            $inmemoryPersistTaskProgress
        );

        $response = $applyAttendeeTaskInteractor->interact(
            new ApplyAttendeeTaskRequest(
                'runner',
                1,
                1,
                ''
            )
        );

        $exceptTaskProgress = RunnerTaskProgress::createFromTask($targetTask, 1, ProgressStatus::apply(), '');
        $this->assertEquals($exceptTaskProgress, $response->getTaskProgress());
        $this->assertContainsEquals($exceptTaskProgress, $inmemoryPersistTaskProgress->getTaskProgresses());
    }

}
