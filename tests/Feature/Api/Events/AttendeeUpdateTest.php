<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Infrastructure\Eloquents\AttendeeTask;
use App\Infrastructure\Eloquents\AttendeeTaskProgress;
use App\Infrastructure\Eloquents\EventAttendee;
use App\Infrastructure\Eloquents\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\AuthAdminUser;
use Tests\Feature\Api\UseNoRoleUser;
use Tests\TestCase;

class AttendeeUpdateTest extends TestCase
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
    public function testAttendeeUpdate()
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

        $response = $this->actingAs($this->authUser(), 'api')->putJson(route('api.v1.attendees.update', [
            'event' => 'rtamarathon',
            'attendee' => $user->id,
        ]), [
            'scopes' => [
                'commentator', 'volunteer',
            ]
        ]);

        $response->assertNoContent();
        $this->assertDatabaseMissing('event_attendees', [
            'user_id' => $user->id,
            'attend_scope' => 'runner',
            'event_id' => 'rtamarathon',
        ]);
        $this->assertDatabaseHas('event_attendees', [
            'user_id' => $user->id,
            'attend_scope' => 'commentator',
            'event_id' => 'rtamarathon',
        ]);
        $this->assertDatabaseHas('event_attendees', [
            'user_id' => $user->id,
            'attend_scope' => 'volunteer',
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
        $user = factory(User::class)->create();
        EventAttendee::create([
            'user_id' => $user->id,
            'attend_scope' => 'runner',
            'event_id' => 'rtamarathon',
        ]);

        $response = $this->actingAs($user, 'api')->putJson(route('api.v1.attendees.update', [
            'event' => 'rtamarathon',
            'attendee' => $user->id,
        ]), [
            'scopes' => [
                'commentator', 'volunteer',
            ]
        ]);

        $response->assertForbidden();
    }

}
