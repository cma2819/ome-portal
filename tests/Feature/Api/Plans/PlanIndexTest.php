<?php

namespace Tests\Feature\Api\Plans;

use App\Infrastructure\Eloquents\EventPlan;
use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\AuthAdminUser;
use Tests\Feature\Api\UseNoRoleUser;
use Tests\TestCase;

class PlanIndexTest extends TestCase
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
    public function testIndexPlan()
    {
        /** @var User */
        $user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $eventPlan = new EventPlan([
            'name' => 'super event',
            'explanation' => 'this is super event excited!!!',
            'status' => 'applied',
        ]);
        $eventPlan->planner_id = $user->id;
        $eventPlan->save();

        $response = $this->actingAs($this->authUser(), 'api')->getJson(route('api.v1.plans.index'));
        $response->assertSuccessful();

        $response->assertJson([
            [
                'name' => $eventPlan->name,
                'planner' => [
                    'id' => $user->id,
                    'username' => $user->name,
                    'discord' => [
                        'id' => $user->discord->discord_id,
                    ]
                ],
                'status' => $eventPlan->status,
                'explanation' => $eventPlan->explanation,
            ]
        ]);
    }

    /** @test */
    public function testIndexPlanNotAdmin()
    {
        $this->useNoRoleUser();

        /** @var User */
        $user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $eventPlan = new EventPlan([
            'name' => 'super event',
            'explanation' => 'this is super event excited!!!',
            'status' => 'applied',
        ]);
        $eventPlan->planner_id = $user->id;
        $eventPlan->save();

        /** @var User */
        $anotherUser = factory(User::class)->create();
        $anotherUserDiscord = new UserDiscord(['discord_id' => '234567891']);
        $anotherUserDiscord->user()->associate($anotherUser);
        $anotherUserDiscord->save();

        $anotherPlan = new EventPlan([
            'name' => 'another event',
            'explanation' => 'this is super event excited!!!',
            'status' => 'approved',
        ]);

        $anotherPlan->planner_id = $user->id;
        $anotherPlan->save();

        $response = $this->actingAs($user, 'api')->getJson(route('api.v1.plans.index'));
        $response->assertSuccessful();

        $response->assertJsonMissing([
            [
                'name' => 'another event',
            ]
        ]);
        $response->assertJson([
            [
                'name' => $eventPlan->name,
                'planner' => [
                    'id' => $user->id,
                    'username' => $user->name,
                    'discord' => [
                        'id' => $user->discord->discord_id,
                    ]
                ],
                'status' => $eventPlan->status,
                'explanation' => $eventPlan->explanation,
            ]
        ]);
    }

}
