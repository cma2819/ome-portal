<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UpdateAuthenticateUserRequest;
use App\Http\Responses\Api\Auth\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ome\Auth\Interfaces\UseCases\EditUserProfile\EditUserProfileRequest;
use Ome\Auth\Interfaces\UseCases\EditUserProfile\EditUserProfileUseCase;

class UpdateAuthenticateUser extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        UpdateAuthenticateUserRequest $request,
        EditUserProfileUseCase $editUserProfileUseCase
    ) {
        $editUserProfileUseCase->interact(
            new EditUserProfileRequest(
                Auth::id(),
                $request->username
            )
        );

        return response()->noContent();
    }
}
