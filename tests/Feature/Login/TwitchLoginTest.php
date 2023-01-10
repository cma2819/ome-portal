<?php

namespace Tests\Feature\Login;

use App\Infrastructure\Eloquents\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Mocks\Domain\Stream\Queries\MockFindTwitchUserById;
use Tests\TestCase;

class TwitchLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testTwitchLoginWithNewUser()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->withSession([
            'twitch_state' => 'oauth-state',
        ])->get(route('auth.twitch', [
            'code' => 'oauth-redirect-code',
            'state' => 'oauth-state',
            'scope' => 'viewing_activity_read',
        ]));

        $mockTwitchUser = (new MockFindTwitchUserById)->fetch('141981764');

        $response->assertRedirect(route('mypage'));
        $this->assertDatabaseHas('twitch_connections', [
            'twitch_user_id' => $mockTwitchUser->getId(),
        ]);
    }

}
