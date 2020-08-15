<?php

namespace Tests\Feature\Api\Twitter\Tweets;

use App\Eloquents\DiscordRolePermission;
use App\Eloquents\User;
use App\Eloquents\UserDiscord;

trait AuthTwitterUser
{
    protected User $user;

    protected function setUpTwitterUser(): void
    {
        $this->user = factory(User::class)->create();
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
