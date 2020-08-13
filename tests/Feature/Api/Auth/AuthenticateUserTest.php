<?php

namespace Tests\Feature\Api\Auth;

use App\Eloquents\User;
use App\Eloquents\UserDiscord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AuthorizeUserTest extends TestCase
{
    /** @test */
    public function testAuthenticateUser()
    {
        $user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '123456789']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $response = $this->actingAs($user, 'api')->getJson(route('api.v1.auth.me'));

        $response->assertSuccessful();
    }

}
