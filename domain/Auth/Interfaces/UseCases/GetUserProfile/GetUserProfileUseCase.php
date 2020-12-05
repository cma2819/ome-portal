<?php

namespace Ome\Auth\Interfaces\UseCases\GetUserProfile;

/**
 * Get User Profile.
 */
interface GetUserProfileUseCase
{
	/**
	 * Get User Profile.
	 */
	public function interact(GetUserProfileRequest $request): GetUserProfileResponse;
}
