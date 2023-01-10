<?php

namespace Tests\Feature\Streams;

use App\Infrastructure\Eloquents\DiscordRolePermission;
use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;

trait AuthStreamInternalUser
{
    protected User $user;

    protected function setUpStreamInternalUser(): void
    {
        $this->user = User::factory()->create();
        $userDiscord = new UserDiscord(['discord_id' => '123456789']);
        $userDiscord->user()->associate($this->user);
        $userDiscord->save();
        DiscordRolePermission::create([
            'discord_role_id' => '41771983423143936',
            'allowed_domain' => 'internal-stream'
        ]);
    }

    protected function streamInternalUser(): User
    {
        return $this->user;
    }
}
