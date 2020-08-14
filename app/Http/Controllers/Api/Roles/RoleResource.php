<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\Roles\RoleResponse;
use Illuminate\Http\Request;
use Ome\Permission\Interfaces\UseCases\ListRolePermission\ListRolePermissionUseCase;

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
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
