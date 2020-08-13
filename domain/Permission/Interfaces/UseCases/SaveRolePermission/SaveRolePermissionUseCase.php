<?php

namespace Ome\Permission\Interfaces\UseCases\SaveRolePermission;

/**
 * Save Role Permission.
 */
interface SaveRolePermissionUseCase
{
	/**
	 * Save Role Permission.
	 */
	public function interact(SaveRolePermissionRequest $request): SaveRolePermissionResponse;
}
