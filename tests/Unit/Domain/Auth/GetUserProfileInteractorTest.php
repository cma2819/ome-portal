<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Entities\PartialDiscordUser;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileRequest;
use Ome\Auth\Queries\InmemoryFindDiscordByIdQuery;
use Ome\Auth\Queries\InmemoryFindUserByIdQuery;
use Ome\Auth\UseCases\GetUserProfileInteractor;
use PHPUnit\Framework\TestCase;

class GetUserProfileInteractorTest extends TestCase
{
    /** @test */
    public function testGetUserProfile()
    {
        $users = [
            User::createRegisteredUser(
                1,
                'superman',
                '123456789',
                ['12345678']
            )
        ];
        $discords = [
            PartialDiscordUser::createPartial(
                '123456789',
                'SuperSuper',
                '4687'
            )
        ];

        $inmemoryFindUser = new InmemoryFindUserByIdQuery($users);
        $inmemoryFindDiscord = new InmemoryFindDiscordByIdQuery($discords);

        $interactor = new GetUserProfileInteractor(
            $inmemoryFindUser,
            $inmemoryFindDiscord
        );

        $profile = $interactor->interact(
            new GetUserProfileRequest(1)
        )->getProfile();

        $this->assertEquals(
            new UserProfile(
                1,
                'superman',
                PartialDiscordUser::createPartial(
                    '123456789',
                    'SuperSuper',
                    '4687'
                )
            ),
            $profile
        );
    }

}
