<?php

namespace Tests\Feature\Api\Schemes;

use App\Infrastructure\Eloquents\EventScheme as EventSchemeEloquent;
use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\AuthAdminUser;
use Tests\Feature\Api\UseNoRoleUser;
use Tests\TestCase;

class SchemeIndexTest extends TestCase
{

    use AuthAdminUser;
    use UseNoRoleUser;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testSchemeIndex()
    {
        /** @var User */
        $user = User::factory()->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $eventScheme = new EventSchemeEloquent([
            'name' => 'Upcoming Event',
            'status' => 'confirmed',
            'start_at' => Carbon::create(2020, 1, 1, 10, 0),
            'end_at' => Carbon::create(2020, 1, 2, 23, 0),
            'explanation' => 'Event explanation',
            'detail' => 'Detail for event.'
        ]);
        $eventScheme->planner_id = $user->id;
        $eventScheme->save();

        $response = $this->actingAs($this->authUser(), 'api')->getJson(route('api.v1.schemes.index'));
        $response->assertSuccessful();

        $response->assertJson([
            [
                'name' => 'Upcoming Event',
                'planner' => [
                    'discord' => [
                        'id' => '198765432'
                    ]
                ],
                'status' => 'confirmed',
                'startAt' => Carbon::create(2020, 1, 1, 10, 0)->toISOString(),
                'endAt' => Carbon::create(2020, 1, 2, 23, 0)->toISOString(),
                'explanation' => 'Event explanation',
                'detail' => 'Detail for event.'
            ]
        ]);
    }

    /** @test */
    public function testSchemeIndexNotAdmin()
    {
        $this->useNoRoleUser();

        /** @var User */
        $user = User::factory()->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $eventScheme = new EventSchemeEloquent([
            'name' => 'Upcoming Event',
            'status' => 'confirmed',
            'start_at' => Carbon::create(2020, 1, 1, 10, 0),
            'end_at' => Carbon::create(2020, 1, 2, 23, 0),
            'explanation' => 'Event explanation',
            'detail' => 'Detail for event.'
        ]);
        $eventScheme->planner_id = $user->id;
        $eventScheme->save();

        /** @var User */
        $anotherUser = User::factory()->create();
        $anotherUserDiscord = new UserDiscord(['discord_id' => '234567891']);
        $anotherUserDiscord->user()->associate($anotherUser);
        $anotherUserDiscord->save();

        $schemeNotAuthUser = new EventSchemeEloquent([
            'name' => 'Not listed event',
            'status' => 'applied',
            'start_at' => Carbon::create(2020, 1, 1, 10, 0),
            'end_at' => Carbon::create(2020, 1, 2, 23, 0),
            'explanation' => 'Event explanation',
            'detail' => 'Detail for event.'
        ]);
        $schemeNotAuthUser->planner_id = $anotherUser->id;
        $schemeNotAuthUser->save();

        $response = $this->actingAs($user, 'api')->getJson(route('api.v1.schemes.index'));
        $response->assertSuccessful();

        $response->assertJsonMissing([
            'name' => 'Not listed event',
        ]);
        $response->assertJson([
            [
                'name' => 'Upcoming Event',
                'planner' => [
                    'discord' => [
                        'id' => '198765432'
                    ]
                ],
                'status' => 'confirmed',
                'startAt' => Carbon::create(2020, 1, 1, 10, 0)->toISOString(),
                'endAt' => Carbon::create(2020, 1, 2, 23, 0)->toISOString(),
                'explanation' => 'Event explanation',
                'detail' => 'Detail for event.'
            ]
        ]);
    }
}
