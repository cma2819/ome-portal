<?php

namespace App\Domain\Auth\Queries;

use App\Exceptions\Auth\AuthenticationFailedException;
use Illuminate\Support\Facades\Auth;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Queries\AuthenticatedUserQuery;

class AppAuthenticatedUserQuery implements AuthenticatedUserQuery
{
    public function fetch(): User
    {
        $user = Auth::user();

        if (is_null($user)) {
            throw new AuthenticationFailedException('Not authenticated.');
        }

        $user->refreshToken();
        $user->save();
        return User::createRegisteredUser($user->id, $user->name, $user->discord->discord_id);
    }
}
