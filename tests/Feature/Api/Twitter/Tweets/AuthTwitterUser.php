<?php

namespace Tests\Feature\Api\Twitter\Tweets;

use App\Infrastructure\Eloquents\DiscordRolePermission;
use App\Infrastructure\Eloquents\User;
use App\Infrastructure\Eloquents\UserDiscord;

trait AuthTwitterUser
{
    protected User $user;

    protected function setUpTwitterUser(): void
    {
        $this->user = User::factory()->create();
        $userDiscord = new UserDiscord(['discord_id' => '123456789']);
        $userDiscord->user()->associate($this->user);
        $userDiscord->save();
        DiscordRolePermission::create([
            'discord_role_id' => '41771983423143936',
            'allowed_domain' => 'twitter'
        ]);
    }

    protected function twitterUser(): User
    {
        return $this->user;
    }
}
