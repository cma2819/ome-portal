<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Infrastructure\Eloquents\AttendeeTask;
use App\Infrastructure\Eloquents\AttendeeTaskProgress;
use App\Infrastructure\Eloquents\EventAttendee;
use App\Infrastructure\Eloquents\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AssertJsonArray;
use Tests\TestCase;

class AttendeeIndexTest extends TestCase
{
    use RefreshDatabase;
    use AssertJsonArray;

    /** @test */
    public function testAttendeeIndex()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);
        /** @var User */
        $user = User::factory()->create();
        $runnerAttendee = EventAttendee::create([
            'user_id' => $user->id,
            'attend_scope' => 'runner',
            'event_id' => 'rtamarathon',
        ]);
        $runnerTask = AttendeeTask::create([
            'event_id' => 'rtamarathon',
            'attendee_scope' => 'runner',
            'content' => 'Please check your sns profile.',
        ]);
        AttendeeTaskProgress::create([
            'event_attendee_id' => $runnerAttendee->id,
            'task_id' => $runnerTask->id,
            'progress_status' => 'apply',
            'note' => 'Checked.'
        ]);

        $commentatorAttendee = EventAttendee::create([
            'user_id' => $user->id,
            'attend_scope' => 'commentator',
            'event_id' => 'rtamarathon',
        ]);
        $commentatorTask = AttendeeTask::create([
            'event_id' => 'rtamarathon',
            'attendee_scope' => 'commentator',
            'content' => 'Please check your mic.'
        ]);
        AttendeeTaskProgress::create([
            'event_attendee_id' => $commentatorAttendee->id,
            'task_id' => $commentatorTask->id,
            'progress_status' => 'approval',
            'note' => 'It is fine!'
        ]);

        $response = $this->getJson(route('api.v1.attendees.index', [
            'event' => 'rtamarathon',
        ]));

        $response->assertSuccessful();
        $this->assertJsonArray($response->json(), '0.scopes', ['runner', 'commentator']);
        $response->assertJson([
            [
                'id' => $user->id,
                'username' => $user->name,
                'taskProgresses' => [
                    'runner' => [
                        [
                            'taskId' => $runnerTask->id,
                            'status' => 'apply',
                            'note' => 'Checked.',
                        ],
                    ],
                    'commentator' => [
                        [
                            'taskId' => $commentatorTask->id,
                            'status' => 'approval',
                            'note' => 'It is fine!',
                        ],
                    ],
                ],
            ],
        ]);

    }
}
