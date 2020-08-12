<?php

namespace Tests\Feature\Login;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ome\Auth\Entities\User;
use Tests\Mocks\Domain\Auth\Queries\MockCurrentDiscordUserQuery;
use Tests\TestCase;

class DiscordLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testDiscordLoginWithNewUser()
    {
        $response = $this->withSession([
            'discord_state' => 'oauth-state',
        ])->get(route('auth.discord', [
            'code' => 'oauth-redirect-code',
            'state' => 'oauth-state',
        ]));

        $mockDiscordUser = (new MockCurrentDiscordUserQuery)->fetch('mock-token');

        $response->assertRedirect(route('index'));
        $this->assertDatabaseHas('users', [
            'name' => $mockDiscordUser->getUsername(),
        ]);
        $this->assertDatabaseHas('user_discords', [
            'discord_id' => $mockDiscordUser->getId()
        ]);
        $this->assertAuthenticated();
    }

}
