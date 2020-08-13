<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\HttpStatusThrowable;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\Auth\UserResponse;
use Illuminate\Http\Request;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserUseCase;

class AuthenticateUser extends Controller
{
    protected GetAuthenticatedUserUseCase $getAuthenticatedUser;

    public function __construct(
        GetAuthenticatedUserUseCase $getAuthenticatedUser
    ) {
        $this->getAuthenticatedUser = $getAuthenticatedUser;
    }

    public function __invoke()
    {
        try {
            $user = $this->getAuthenticatedUser->interact()->getUser();
        } catch (HttpStatusThrowable $e) {
            abort($e->getStatusCode());
        }

        return new UserResponse($user);
    }
}
