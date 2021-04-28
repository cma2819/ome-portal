<?php

namespace Tests\Feature\Api\Plans;

use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\UseNoRoleUser;
use Tests\TestCase;

class PlanStoreTest extends TestCase
{

    use UseNoRoleUser;
    use RefreshDatabase;

    /**
     * @test
     */
    public function testStorePlan()
    {
        $this->useNoRoleUser();

        /** @var User */
        $user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '198765432']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $response = $this->actingAs($user, 'api')->postJson(route('api.v1.plans.store'), [
            'name' => 'This is event plan.',
            'explanation' => 'This is super exciting event. please make real!!',
        ]);
        $response->assertSuccessful();

        $response->assertJson([
            'name' => 'This is event plan.',
            'planner' => [
                'id' => $user->id,
                'username' => $user->name,
                'discord' => [
                    'id' => $userDiscord->discord_id,
                ],
            ],
            'status' => 'applied',
            'explanation' => 'This is super exciting event. please make real!!',
        ]);
        $this->assertDatabaseHas('event_plans', [
            'name' => 'This is event plan.',
            'planner_id' => $user->id,
            'status' => 'applied',
            'explanation' => 'This is super exciting event. please make real!!',
        ]);
    }
}
