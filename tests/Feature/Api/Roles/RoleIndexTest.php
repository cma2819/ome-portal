<?php

namespace Tests\Feature\Api\Roles;

use App\Eloquents\DiscordRolePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class RoleIndexTest extends TestCase
{
    use RefreshDatabase;
    use AuthAdminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testRoleIndex()
    {
        DiscordRolePermission::create([
            'discord_role_id' => '41771983423143936',
            'allowed_domain' => 'twitter'
        ]);

        $response = $this->actingAs($this->authUser(), 'api')->getJson(route('api.v1.roles.index'));

        $response->assertSuccessful();
        $response->assertJson([
            [
                'id' => '41771983423143936',
                'name' => 'WE DEM BOYZZ!!!!!!',
                'permissions' => ['admin', 'twitter']
            ]
        ]);
    }

}
