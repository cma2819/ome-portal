<?php

namespace Tests\Feature\Api\Users;

use App\Infrastructure\Eloquents\TwitchConnection;
use App\Infrastructure\Eloquents\User as UserEloquent;
use App\Infrastructure\Eloquents\UserDiscord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AssertJsonArray;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class UserIndexTest extends TestCase
{
    use RefreshDatabase;
    use AuthAdminUser;
    use AssertJsonArray;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /**
     * @test
     * @dataProvider provideUsers
     */
    public function testIndexTest($users)
    {
        foreach ($users as $user) {
            $eloquent = new UserEloquent;
            $eloquent->id = $user['id'];
            $eloquent->name = $user['username'];
            $eloquent->refreshToken();
            $eloquent->save();

            $discord = new UserDiscord;
            $discord->discord_id = $user['discord']['id'];
            $discord->user()->associate($eloquent);
            $discord->save();

            foreach ($user['channels']['twitch'] as $json) {
                $twitch = new TwitchConnection([
                    'twitch_user_id' => $json['id'],
                ]);
                $eloquent->twitch()->save($twitch);
            }
        }

        $response = $this->actingAs($this->authUser(), 'api')->getJson(route('api.v1.users.index', ['page' => 0]));
        $response->assertSuccessful();

        $response->assertJson([
            'prev' => null,
            'current' => 0,
            'next' => null,
        ]);
        $this->assertJsonArray($response->json(), 'data', $users);
    }

    public function provideUsers(): array
    {
        return [
            [// Case 1
                [// Argument 1
                    [
                        'id' => 2,
                        'username' => 'superman',
                        'discord' => [
                            'id' => '111111111'
                        ],
                        'channels' => [
                            'twitch' => [
                                [
                                    'id' => '14123456'
                                ]
                            ]
                        ],
                    ],
                    [
                        'id' => 3,
                        'username' => 'nextman',
                        'discord' => [
                            'id' => '222222222'
                        ],
                        'channels' => [
                            'twitch' => [
                                [
                                    'id' => '24123456'
                                ]
                            ]
                        ],
                    ],
                    [
                        'id' => 4,
                        'username' => 'thirdman',
                        'discord' => [
                            'id' => '333333333'
                        ],
                        'channels' => [
                            'twitch' => [
                                [
                                    'id' => '34123456'
                                ]
                            ]
                        ],
                    ],
                    [
                        'id' => 5,
                        'username' => 'cmario',
                        'discord' => [
                            'id' => '444444444'
                        ],
                        'channels' => [
                            'twitch' => [
                                [
                                    'id' => '44123456'
                                ]
                            ]
                        ],
                    ],
                    [
                        'id' => 6,
                        'username' => 'hello',
                        'discord' => [
                            'id' => '555555555'
                        ],
                        'channels' => [
                            'twitch' => [
                                [
                                    'id' => '54123456'
                                ]
                            ]
                        ],
                    ],
                ]
            ]
        ];
    }
}
