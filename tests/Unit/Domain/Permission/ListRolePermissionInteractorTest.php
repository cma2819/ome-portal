<?php

namespace Tests\Unit\Domain\Permission;

use Ome\Permission\Entities\PartialRole;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Dto\RoleDto;
use Ome\Permission\Queries\InmemoryListPermissions;
use Ome\Permission\UseCases\ListRolePermissionInteractor;
use Ome\Permission\Values\Domain;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Permission\Queries\MockListRolesQuery;

class ListRolePermissionInteractorTest extends TestCase
{

    /** @test */
    public function testListRolePermission()
    {
        $permissionForMock = RolePermission::create('41771983423143936', [Domain::admin()]);

        $listRolePermission = new ListRolePermissionInteractor(
            new MockListRolesQuery,
            new InmemoryListPermissions([
                RolePermission::create('41771983423143936', [
                    Domain::admin()
                ])
            ])
        );

        $response = $listRolePermission->interact();

        $this->assertContainsEquals(
            new RoleDto(PartialRole::createPartial('41771983423143936', 'WE DEM BOYZZ!!!!!!'), $permissionForMock),
            $response->getRolePermissions()
        );
    }

}
