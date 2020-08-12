<?php

namespace Tests\Feature\Login;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiscordLoginTest extends TestCase
{
    /** @test */
    public function testDiscordLogin()
    {
        $response = $this->withSession([
            'discord_state' => 'oauth-state',
        ])->get(route('auth.discord', [
            'code' => 'oauth-redirect-code',
            'state' => 'oauth-state',
        ]));

        $response->assertSuccessful();
    }

}
