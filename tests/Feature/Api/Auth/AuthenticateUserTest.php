<?php

namespace Tests\Feature\Api\Auth;

use App\Eloquents\User;
use App\Eloquents\UserDiscord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Values\Domain;
use Tests\TestCase;

class AuthorizeUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testAuthenticateUser()
    {
        $this->app->bind('InmemoryPermissionStore', function ($app) {
            return [
                RolePermission::create('41771983423143936', [
                    Domain::twitter(),
                    Domain::admin()
                ])
            ];
        });
        /** @var User */
        $user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '123456789']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();

        $response = $this->actingAs($user, 'api')->getJson(route('api.v1.auth.me'));

        $response->assertSuccessful();
        $response->assertJson([
            'id' => $user->id,
            'username' => $user->name,
            'discord' => [
                'id' => $userDiscord->discord_id,
            ],
            'permissions' => [
                'twitter', 'admin'
            ],
        ]);
    }

}
