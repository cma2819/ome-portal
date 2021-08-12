<?php

namespace App\Infrastructure\Queries\Auth;

use App\Exceptions\Auth\AuthenticationFailedException;
use App\Facades\Logger;
use AuthDiscord\AuthDiscord;
use Illuminate\Support\Facades\Http;
use Ome\Auth\Interfaces\Queries\AuthenticateTokenQuery;

class DiscordAuthenticateTokenQuery implements AuthenticateTokenQuery
{
    protected AuthDiscord $authDiscord;

    public function __construct(
        AuthDiscord $authDiscord
    ) {
        $this->authDiscord = $authDiscord;
    }

    public function fetch(string $clientId, string $clientSecret, string $code, string $redirectUrl, array $scopes): string
    {
        return $this->authDiscord->getAuthenticateToken(
            $clientId,
            $clientSecret,
            $code,
            $redirectUrl,
            $scopes
        );
    }
}
