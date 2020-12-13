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

class SchemeUpdateTest extends TestCase
{
    use AuthAdminUser;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testSchemeUpdate()
    {
        /** @var User */
        $user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $eventScheme = new EventSchemeEloquent([
            'name' => 'Upcoming Event',
            'status' => 'applied',
            'start_at' => null,
            'end_at' => null,
            'explanation' => 'Event explanation',
            'detail' => 'Detail for event.'
        ]);
        $eventScheme->planner_id = $user->id;
        $eventScheme->save();

        $response = $this->actingAs($this->authUser(), 'api')->putJson(route('api.v1.schemes.update', [
            'scheme' => $eventScheme->id,
        ]), [
            'name' => 'Edit Event',
            'startAt' => Carbon::create(2020, 1, 2, 10, 0)->toISOString(),
            'endAt' => Carbon::create(2020, 1, 3, 21, 0)->toISOString(),
            'explanation' => 'Edit explanation',
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('event_schemes', [
            'id' => $eventScheme->id,
            'name' => 'Edit Event',
            'status' => 'applied',
            'start_at' => Carbon::create(2020, 1, 2, 10, 0)->toISOString(),
            'end_at' => Carbon::create(2020, 1, 3, 21, 0)->toISOString(),
            'explanation' => 'Edit explanation',
            'detail' => 'Detail for event.'
        ]);
    }

}
