<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Commands\InmemoryPersistUserCommand;
use Ome\Auth\Entities\PartialDiscordUser;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\UseCases\AuthorizeWithDiscordUser\AuthorizeWithDiscordUserRequest;
use Ome\Auth\Queries\InmemoryFindUserByDiscordQuery;
use Ome\Auth\UseCases\AuthorizeWithDiscordUserInteractor;
use PHPUnit\Framework\TestCase;

class AuthorizeWithDiscordUserInteractorTest extends TestCase
{
    protected InmemoryFindUserByDiscordQuery $findUserByDiscordQuery;

    protected InmemoryPersistUserCommand $persistUserCommand;

    protected function setUp(): void
    {
        parent::setUp();
        $users = [
            User::createRegisteredUser(1, 'user1', '0000001')
        ];

        $this->findUserByDiscordQuery = new InmemoryFindUserByDiscordQuery($users);
        $this->persistUserCommand = new InmemoryPersistUserCommand($users);
    }


    /** @test */
    public function testAuthorizeExistsUser()
    {
        $authorizeInteractor = new AuthorizeWithDiscordUserInteractor(
            $this->findUserByDiscordQuery,
            $this->persistUserCommand
        );

        $result = $authorizeInteractor->interact(new AuthorizeWithDiscordUserRequest(
            PartialDiscordUser::createPartial('0000001', 'user1', '1234')
        ));

        $this->assertEquals(User::createRegisteredUser(1, 'user1', '0000001'), $result->getUser());
    }

    /** @test */
    public function testAuthorizeNotExistsUser()
    {
        $authorizeInteractor = new AuthorizeWithDiscordUserInteractor(
            $this->findUserByDiscordQuery,
            $this->persistUserCommand
        );

        $result = $authorizeInteractor->interact(new AuthorizeWithDiscordUserRequest(
            PartialDiscordUser::createPartial('1000001', 'user2', '9785')
        ));

        $newUser = User::createRegisteredUser(2, 'user2', '1000001');
        $this->assertEquals($newUser, $result->getUser());
        $this->assertContainsEquals($newUser, $this->persistUserCommand->getUsers());
    }
}
