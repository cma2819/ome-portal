<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Infrastructure\Eloquents\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AssertJsonArray;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class AttendeeStoreTest extends TestCase
{

    use RefreshDatabase;
    use AuthAdminUser;
    use AssertJsonArray;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testStoreAttendee()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);
        /** @var User */
        $user = User::factory()->create();

        $response = $this->actingAs($this->authUser(), 'api')->postJson(route('api.v1.attendees.store', [
            'event' => 'rtamarathon',
        ]),[
            'id' => $user->id,
            'scopes' => [
                'runner',
                'commentator',
                'volunteer',
            ]
        ]);

        $response->assertSuccessful();
        $response->assertJson([
            'id' => $user->id,
            'username' => $user->name,
            'taskProgresses' => [],
        ]);
        $this->assertJsonArray($response->json(), 'scopes', [
            'runner',
            'commentator',
            'volunteer'
        ]);

        $this->assertDatabaseHas('event_attendees', [
            'event_id' => 'rtamarathon',
            'user_id' => $user->id,
            'attend_scope' => 'runner'
        ]);
        $this->assertDatabaseHas('event_attendees', [
            'event_id' => 'rtamarathon',
            'user_id' => $user->id,
            'attend_scope' => 'commentator'
        ]);
        $this->assertDatabaseHas('event_attendees', [
            'event_id' => 'rtamarathon',
            'user_id' => $user->id,
            'attend_scope' => 'volunteer'
        ]);
    }

}
