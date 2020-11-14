<?php

namespace App\Infrastructure\Commands\Auth;

use App\Infrastructure\Eloquents\User as EloquentsUser;
use App\Infrastructure\Eloquents\UserDiscord;
use App\Facades\Logger;
use Illuminate\Support\Facades\DB;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Commands\PersistUserCommand;

class PersistUserEloquentCommand implements PersistUserCommand
{
    public function execute(User $user): User
    {
        /** @var User */
        $persistUser = DB::transaction(function () use ($user) {
            $userEloquent = new EloquentsUser(['name' => $user->getUsername()]);
            $userEloquent->refreshToken();
            $userEloquent->save();

            $userDiscord = new UserDiscord(['discord_id' => $user->getDiscordId()]);
            $userDiscord->user()->associate($userEloquent);
            $userDiscord->save();

            return User::createRegisteredUser(
                $userEloquent->id,
                $userEloquent->name,
                $userDiscord->discord_id
            );
        });
        Logger::debug('string', 'Auth.Command', 'Persist user has ID:' . $persistUser->getId());

        return $persistUser;
    }
}
