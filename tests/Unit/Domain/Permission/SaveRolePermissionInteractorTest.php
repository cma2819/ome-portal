<?php

namespace Tests\Unit\Domain\Permission;

use Ome\Permission\Commands\InmemoryPersistRolePermission;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionRequest;
use Ome\Permission\UseCases\SaveRolePermissionInteractor;
use Ome\Permission\Values\Domain;
use PHPUnit\Framework\TestCase;

class SaveRolePermissionInteractorTest extends TestCase
{
    /** @test */
    public function testSaveRolePermission()
    {
        $inmemoryPersistRolePermission = new InmemoryPersistRolePermission;

        $expectRolePermission = RolePermission::create('123456789', [
            Domain::twitter(),
            Domain::admin(),
        ]);

        $saveRolePermission = new SaveRolePermissionInteractor($inmemoryPersistRolePermission);
        $response = $saveRolePermission->interact(new SaveRolePermissionRequest('123456789', ['twitter', 'admin']));

        $this->assertEquals($expectRolePermission, $response->getRolePermission());
        $this->assertContainsEquals($expectRolePermission, $inmemoryPersistRolePermission->getPermissions());
    }
}
