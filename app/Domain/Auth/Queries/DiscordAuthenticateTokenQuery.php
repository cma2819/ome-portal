<?php

namespace App\Domain\Auth\Queries;

use App\Exceptions\Discord\AuthenticationFailedException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery;

class DiscordAuthenticateTokenQuery implements AuthenticateTokenQuery
{
    private const DISCORD_TOKEN_API_URL = 'https://discord.com/api/oauth2/token';

    public function fetch(string $clientId, string $clientSecret, string $code, string $redirectUrl, array $scopes): string
    {
        $parameters = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUrl,
            'scope' => implode(' ', $scopes),
        ];

        $response = Http::asForm()->post(self::DISCORD_TOKEN_API_URL, $parameters);

        if ($response->failed()) {
            Log::error('Failed Authentication with discord.');
            Log::error('Send parameters: ' . json_encode($parameters));
            Log::error('Response: ' . $response->body());
            throw new AuthenticationFailedException('Failed to get oauth token from discord api.');
        }

        return json_decode($response->body())->access_token;
    }
}
