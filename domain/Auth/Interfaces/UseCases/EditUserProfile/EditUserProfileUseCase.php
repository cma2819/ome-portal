<?php

namespace Ome\Auth\Interfaces\UseCases\EditUserProfile;

/**
 * Edit User Profile.
 */
interface EditUserProfileUseCase
{
	/**
	 * Edit User Profile.
	 */
	public function interact(EditUserProfileRequest $request): EditUserProfileResponse;
}
