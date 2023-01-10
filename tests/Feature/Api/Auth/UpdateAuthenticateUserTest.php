<?php

namespace Tests\Feature\Api\Auth;

use App\Infrastructure\Eloquents\User as UserEloquent;
use App\Infrastructure\Eloquents\UserDiscord as UserDiscordEloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateAuthenticateUserTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function testUpdateAuthenticateUser()
    {
        /** @var UserEloquent */
        $userEloquent = UserEloquent::factory()->create();
        $userDiscord = new UserDiscordEloquent(['discord_id' => '100000000']);
        $userDiscord->user()->associate($userEloquent);
        $userDiscord->save();

        $response = $this->actingAs($userEloquent, 'api')->putJson(route('api.v1.auth.me.update', [
            'username' => 'new_username'
        ]));

        $response->assertSuccessful();
        $this->assertDatabaseHas('users', [
            'id' => $userEloquent->id,
            'name' => 'new_username',
        ]);
    }

}
