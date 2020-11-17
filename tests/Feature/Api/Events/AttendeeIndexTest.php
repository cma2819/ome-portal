<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Infrastructure\Eloquents\AttendeeTask;
use App\Infrastructure\Eloquents\AttendeeTaskProgress;
use App\Infrastructure\Eloquents\EventAttendee;
use App\Infrastructure\Eloquents\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttendeeIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testAttendeeIndex()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);
        /** @var User */
        $user = factory(User::class)->create();
        $attendee = EventAttendee::create([
            'user_id' => $user->id,
            'attend_scope' => 'runner',
            'event_id' => 'rtamarathon',
        ]);
        $task = AttendeeTask::create([
            'event_id' => 'rtamarathon',
            'attendee_scope' => 'runner',
            'content' => 'Please check your sns profile.',
        ]);
        AttendeeTaskProgress::create([
            'event_attendee_id' => $attendee->id,
            'task_id' => $task->id,
            'progress_status' => 'apply',
            'note' => 'Checked.'
        ]);

        $response = $this->getJson(route('api.v1.attendees.index', [
            'event' => 'rtamarathon',
        ]));

        $response->assertSuccessful();
    }
}
