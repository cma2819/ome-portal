<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Infrastructure\Eloquents\AttendeeTask;
use App\Infrastructure\Eloquents\AttendeeTaskProgress;
use App\Infrastructure\Eloquents\EventAttendee;
use App\Infrastructure\Eloquents\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ome\Permission\Interfaces\Queries\GetPermissionForRoleQuery;
use Tests\Feature\Api\AuthAdminUser;
use Tests\Feature\Api\UseNoRoleUser;
use Tests\TestCase;

class AttendeeDestroyTest extends TestCase
{

    use RefreshDatabase;
    use AuthAdminUser;
    use UseNoRoleUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testAttendeeDestroy()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);
        /** @var User */
        $user = factory(User::class)->create();
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

        $response = $this->actingAs($this->authUser(), 'api')->deleteJson(route('api.v1.attendees.destroy', [
            'event' => 'rtamarathon',
            'attendee' => $user->id,
        ]));

        $response->assertNoContent();

        $this->assertDatabaseMissing('event_attendees', [
            'user_id' => $user->id,
            'event_id' => 'rtamarathon',
        ]);
    }

    /** @test */
    public function testNoAuthorization()
    {
        $this->useNoRoleUser();

        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);
        /** @var User */
        $user = factory(User::class)->create([
            'id' => $this->authUser()->id + 1,
        ]);
        EventAttendee::create([
            'user_id' => $user->id,
            'attend_scope' => 'runner',
            'event_id' => 'rtamarathon',
        ]);

        $response = $this->actingAs($user, 'api')->deleteJson(route('api.v1.attendees.destroy', [
            'event' => 'rtamarathon',
            'attendee' => $user->id,
        ]));

        $response->assertForbidden();
    }


}
