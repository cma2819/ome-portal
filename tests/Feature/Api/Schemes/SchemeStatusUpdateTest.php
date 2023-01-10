<?php

namespace Tests\Feature\Api\Schemes;

use App\Infrastructure\Eloquents\EventScheme as EventSchemeEloquent;
use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class SchemeStatusUpdateTest extends TestCase
{
    use AuthAdminUser;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testStatusUpdateSuccess()
    {
        /** @var User */
        $user = User::factory()->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $eventScheme = new EventSchemeEloquent([
            'name' => 'Upcoming Event',
            'status' => 'applied',
            'start_at' => Carbon::create(2020, 1, 1, 10, 0),
            'end_at' => Carbon::create(2020, 1, 2, 23, 0),
            'explanation' => 'Event explanation',
            'detail' => 'Detail for event.'
        ]);
        $eventScheme->planner_id = $user->id;
        $eventScheme->save();

        Carbon::setTestNow(
            Carbon::create(2020, 1, 2, 12, 34, 56)
        );

        $response = $this->actingAs($this->authUser(), 'api')->putJson(
            route('api.v1.schemes.status.update', [
                'id' => $eventScheme->id,
            ]),
            [
                'status' => 'approved',
                'reply' => 'approve your event!'
            ]
        );

        $response->assertNoContent();
        $this->assertDatabaseHas('event_schemes', [
            'id' => $eventScheme->id,
            'status' => 'approved',
        ]);
        $this->assertDatabaseHas('event_scheme_replies', [
            'scheme_id' => $eventScheme->id,
            'to_status' => 'approved',
            'admin_reply' => 'approve your event!',
            'replied_at' => Carbon::create(2020, 1, 2, 12, 34, 56),
        ]);
    }

    /** @test */
    public function testStatusUpdateNotFound()
    {
        $response = $this->actingAs($this->authUser(), 'api')->putJson(route('api.v1.schemes.status.update', [
            'id' => 1,
        ]), [
            'status' => 'approved',
            'reply' => 'approve your event!',
        ]);

        $response->assertNotFound();
    }

    /** @test */
    public function testStatusUpdateByNotAdmin()
    {
        /** @var User */
        $user = User::factory()->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $eventScheme = new EventSchemeEloquent([
            'name' => 'Upcoming Event',
            'status' => 'applied',
            'start_at' => Carbon::create(2020, 1, 1, 10, 0),
            'end_at' => Carbon::create(2020, 1, 2, 23, 0),
            'explanation' => 'Event explanation',
            'detail' => 'Detail for event.'
        ]);
        $eventScheme->planner_id = $user->id;
        $eventScheme->save();

        $response = $this->actingAs($user)->putJson(route('api.v1.schemes.status.update', [
            'id' => $eventScheme->id,
        ]), [
            'status' => 'approved',
            'reply' => 'approve your event!',
        ]);

        $response->assertUnauthorized();
    }

}
