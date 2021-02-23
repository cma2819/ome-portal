<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Commands\InmemoryPersistUserCommand;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\UseCases\EditUserProfile\EditUserProfileRequest;
use Ome\Auth\Queries\InmemoryFindUserByIdQuery;
use Ome\Auth\UseCases\EditUserProfileInteractor;
use PHPUnit\Framework\TestCase;

class EditUserProfileInteractorTest extends TestCase
{
    /** @test */
    public function testEditUserProfile()
    {
        $users = [
            User::createRegisteredUser(
                1,
                'old_username',
                '123456789'
            )
        ];
        $findUserQuery = new InmemoryFindUserByIdQuery($users);
        $persistUserCommand = new InmemoryPersistUserCommand($users);

        $interactor = new EditUserProfileInteractor(
            $findUserQuery,
            $persistUserCommand
        );

        $result = $interactor->interact(
            new EditUserProfileRequest(1, 'new_username')
        );

        $expected = User::createRegisteredUser(1, 'new_username', '123456789');
        $this->assertEquals(
            $expected,
            $result->getUser()
        );
        $this->assertContainsEquals(
            $expected,
            $persistUserCommand->getUsers()
        );
    }

}
