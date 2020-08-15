<?php

namespace App\Http\Controllers\Api\Roles;

use App\Exceptions\HttpStatusThrowable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Roles\RoleUpdateRequest;
use App\Http\Responses\Api\Roles\RoleResponse;
use Illuminate\Http\Request;
use Ome\Permission\Interfaces\UseCases\ListRolePermission\ListRolePermissionUseCase;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionRequest;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionUseCase;

class RoleResource extends Controller
{
    protected ListRolePermissionUseCase $listRolePermission;

    public function __construct(
        ListRolePermissionUseCase $listRolePermission
    ) {
        $this->listRolePermission = $listRolePermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return RoleResponse[]
     */
    public function index()
    {
        $roleDtoList = $this->listRolePermission->interact()->getRolePermissions();
        $roles = [];
        foreach ($roleDtoList as $roleDto) {
            $roles[] = new RoleResponse(
                $roleDto->getRole(),
                $roleDto->getPermission()
            );
        }

        return $roles;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(
        RoleUpdateRequest $request,
        string $id,
        SaveRolePermissionUseCase $saveRolePermission
    ) {
        try {
            $saveRolePermission->interact(new SaveRolePermissionRequest($id, $request->permissions));
        } catch (HttpStatusThrowable $e) {
            abort($e->getStatusCode());
        }

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
