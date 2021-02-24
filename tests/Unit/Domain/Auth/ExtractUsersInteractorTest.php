<?php

namespace Tests\Unit\Domain\Auth;

use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\UseCases\ExtractUsers\ExtractUsersRequest;
use Ome\Auth\Queries\InmemoryCountUsersQuery;
use Ome\Auth\Queries\InmemoryListUsersQuery;
use Ome\Auth\UseCases\ExtractUsersInteractor;
use PHPUnit\Framework\TestCase;

class ExtractUsersInteractorTest extends TestCase
{
    /** @test */
    public function testExtractUsers()
    {
        $users = [
            User::createRegisteredUser(
                1,
                'superman',
                '123456789',
                ['12345678']
            ),
            User::createRegisteredUser(
                2,
                'nextman',
                '222222222',
                ['22345678']
            ),
            User::createRegisteredUser(
                3,
                'helloman',
                '333333333',
                ['32345678']
            ),
            User::createRegisteredUser(
                4,
                'cmario',
                '444444444',
                ['42345678']
            ),
            User::createRegisteredUser(
                5,
                'hello',
                '555555555',
                ['52345678']
            ),
        ];

        $listUsersQuery = new InmemoryListUsersQuery($users);
        $countUsersQuery = new InmemoryCountUsersQuery($users);

        $interactor = new ExtractUsersInteractor($listUsersQuery, $countUsersQuery);

        $result = $interactor->interact(new ExtractUsersRequest(0));

        $this->assertEquals($users, $result->getUsers());
        $this->assertEquals(false, $result->getHasNext());
    }

}
