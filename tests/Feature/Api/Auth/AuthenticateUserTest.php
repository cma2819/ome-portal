<?php

namespace Tests\Feature\Api\Auth;

use App\Api\Discord\DiscordApiClient;
use App\Infrastructure\Eloquents\DiscordRolePermission;
use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;
use App\Infrastructure\Queries\Permission\GetDiscordRolesForUserQuery;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Queries\GetRolesForUserQuery;
use Ome\Permission\Values\Domain;
use Ome\Stream\Entities\Streamer;
use Ome\Stream\Entities\TwitchUser;
use Ome\Stream\Interfaces\Queries\FindStreamerByIdQuery;
use Ome\Stream\Queries\InmemoryFindStreamerById;
use Tests\AssertJsonArray;
use Tests\Mocks\Domain\Auth\Queries\MockFindDiscordByIdQuery;
use Tests\TestCase;

class AuthenticateUserTest extends TestCase
{
    use RefreshDatabase;
    use AssertJsonArray;

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
        $this->app->bind(
            FindDiscordByIdQuery::class,
            MockFindDiscordByIdQuery::class
        );

        /** @var User */
        $user = User::factory()->create();
        $streamers = [
            Streamer::createRegisteredStreamer(
                $user->id,
                [
                    TwitchUser::createRegistered(
                        '141981764',
                        'twitchdev',
                        'TwitchDev'
                    )
                ],
                []
            )
        ];
        $inmemoryFindStreamer = new InmemoryFindStreamerById($streamers);
        $this->app->instance(
            FindStreamerByIdQuery::class,
            $inmemoryFindStreamer
        );

        $userDiscord = new UserDiscord(['discord_id' => '123456789']);
        $userDiscord->user()->associate($user);
        $userDiscord->save();
        DiscordRolePermission::create([
            'discord_role_id' => '41771983423143936',
            'allowed_domain' => 'twitter'
        ]);
        DiscordRolePermission::create([
            'discord_role_id' => '41771983423143936',
            'allowed_domain' => 'admin'
        ]);
        $response = $this->actingAs($user, 'api')->getJson(route('api.v1.auth.me'));

        $response->assertSuccessful();
        $response->assertJson([
            'id' => $user->id,
            'username' => $user->name,
            'discord' => [
                'id' => $userDiscord->discord_id,
                'username' => 'Nelly',
                'discriminator' => '1234'
            ],
            'channels' => [
                'twitch' => [
                    [
                        'id' => '141981764',
                        'username' => 'twitchdev',
                    ]
                ],
            ],
            'thumbnail' => 'https://cdn.example.com/avatars/' . $userDiscord->discord_id . '/avatar_test.png',
        ]);
        $this->assertJsonArray($response->json(), 'permissions', ['twitter', 'admin']);
    }

    /** @test */
    public function testUserNotInHostGuild()
    {
        $this->app->bind(
            FindDiscordByIdQuery::class,
            MockFindDiscordByIdQuery::class
        );

        $this->app->bind(
            GetRolesForUserQuery::class,
            GetDiscordRolesForUserQuery::class
        );
        $discordMock = new MockHandler([
            new Response(404),
        ]);
        $handlerStack = HandlerStack::create($discordMock);
        $this->app->instance(
            DiscordApiClient::class,
            new DiscordApiClient(
                new Client(['handler' => $handlerStack]),
                'invalid token',
                3600
            )
        );

        /** @var User */
        $user = User::factory()->create();

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
                'username' => 'Nelly',
                'discriminator' => '1234'
            ],
            'channels' => [
                'twitch' => [],
            ],
            'thumbnail' => 'https://cdn.example.com/avatars/' . $userDiscord->discord_id . '/avatar_test.png',
        ]);
        $this->assertEmpty($response->json()['permissions']);
    }

}
