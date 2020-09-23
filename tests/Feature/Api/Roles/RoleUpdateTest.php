<?php

namespace Tests\Feature\Api\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class RoleUpdateTest extends TestCase
{
    use RefreshDatabase;
    use AuthAdminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testRoleUpdate()
    {
        $response = $this->actingAs($this->authUser(), 'api')->putJson(route('api.v1.roles.update', ['role' => '123456789']), [
            'permissions' => ['twitter', 'admin', 'internal-stream']
        ]);

        $response->assertNoContent();
        $this->assertDatabaseHas('discord_role_permissions', [
            'discord_role_id' => '123456789',
            'allowed_domain' => 'twitter'
        ]);
        $this->assertDatabaseHas('discord_role_permissions', [
            'discord_role_id' => '123456789',
            'allowed_domain' => 'admin'
        ]);
        $this->assertDatabaseHas('discord_role_permissions', [
            'discord_role_id' => '123456789',
            'allowed_domain' => 'internal-stream'
        ]);
    }

}
