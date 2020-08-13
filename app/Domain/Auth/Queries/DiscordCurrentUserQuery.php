<?php

namespace App\Domain\Auth\Queries;

use Illuminate\Support\Facades\Http;
use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Interfaces\Queries\CurrentDiscordUserQuery;

class DiscordCurrentUserQuery implements CurrentDiscordUserQuery
{
    private const DISCORD_USER_ME_ENDPOINT = '/users/@me';

    public function fetch(string $token): DiscordUser
    {
        $url = config('services.discord.api_url') . self::DISCORD_USER_ME_ENDPOINT;
        $response = Http::withToken($token)->get($url);

        return DiscordUser::createFromApiJson(json_decode($response->body(), true));
    }
}
