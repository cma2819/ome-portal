<?php

namespace Tests\Unit\Domain\Permission;

use Ome\Permission\Entities\PartialRole;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Dto\RoleDto;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserRequest;
use Ome\Permission\Queries\InmemoryGetPermissionForRole;
use Ome\Permission\UseCases\GetRolePermissionByUserInteractor;
use Ome\Permission\Values\Domain;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Permission\Queries\MockGetRolesForUserQuery;

class GetRolePermissionByUserInteractorTest extends TestCase
{
    /** @test */
    public function testGetRolePermissionByUser()
    {

        $initialPermission = RolePermission::create('41771983423143936', [
            Domain::twitter(),
            Domain::admin()
        ]);

        $getRolePermissionByUser = new GetRolePermissionByUserInteractor(
            new MockGetRolesForUserQuery,
            new InmemoryGetPermissionForRole([$initialPermission])
        );

        $result = $getRolePermissionByUser->interact(new GetRolePermissionByUserRequest(1));

        $this->assertEquals(
            [new RoleDto(PartialRole::createPartial('41771983423143936', 'WE DEM BOYZZ!!!!!!'), $initialPermission)],
            $result->getRolePermissions()
        );
    }
}
