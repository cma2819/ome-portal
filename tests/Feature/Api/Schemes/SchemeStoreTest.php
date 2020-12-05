<?php

namespace Tests\Feature\Api\Schemes;

use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UseNoRoleUser;
use Tests\TestCase;

class SchemeStoreTest extends TestCase
{
    use UseNoRoleUser;
    use RefreshDatabase;

    /**
     * @test
     * @dataProvider provideSuccessScheme
     */
    public function testSchemeStore($params)
    {
        $this->useNoRoleUser();

        /** @var User */
        $user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $response = $this->actingAs($user, 'api')->postJson(route('api.v1.schemes.store'), $params);
        $response->assertSuccessful();

        $this->assertDatabaseHas('event_schemes', [
            'planner_id' => $user->id,
            'name' => $params['name'],
            'status' => 'applied',
            'start_at' => $params['startAt'],
            'end_at' => $params['endAt'],
            'explanation' => $params['explanation'],
            'detail' => '',
        ]);
    }

    public function provideSuccessScheme()
    {
        return [
            [
                [
                    'name' => 'Upcoming Event!',
                    'startAt' => Carbon::create(2020, 1, 1, 10, 0)->toISOString(),
                    'endAt' => Carbon::create(2020, 1, 2, 23, 0)->toISOString(),
                    'explanation' => 'This event is some explanation.',
                ]
            ],
            [
                [
                    'name' => 'Upcoming Event!',
                    'startAt' => null,
                    'endAt' => null,
                    'explanation' => 'This event is some explanation.',
                ]
            ],
        ];
    }

}
