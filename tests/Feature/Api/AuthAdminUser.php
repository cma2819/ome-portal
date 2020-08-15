<?php

namespace Tests\Feature\Api;

use App\Eloquents\DiscordRolePermission;
use App\Eloquents\User;
use App\Eloquents\UserDiscord;

trait AuthAdminUser
{
    protected User $user;

    protected function setUpAdminUser(): void
    {
        $this->user = factory(User::class)->create();
        $userDiscord = new UserDiscord(['discord_id' => '123456789']);
        $userDiscord->user()->associate($this->user);
        $userDiscord->save();
        DiscordRolePermission::create([
            'discord_role_id' => '41771983423143936',
            'allowed_domain' => 'admin'
        ]);
    }

    protected function authUser(): User
    {
        return $this->user;
    }
}
