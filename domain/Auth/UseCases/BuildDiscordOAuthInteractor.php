<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthResponse;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;
use Ome\OAuth\Interfaces\OAuthStateGenerator;

class BuildDiscordOAuthInteractor implements BuildDiscordOAuthUseCase
{
    public const DISCORD_OAUTH_URL = 'https://discord.com/api/oauth2/authorize';

    protected OAuthStateGenerator $stateGenerator;

    public function __construct(
        OAuthStateGenerator $stateGenerator
    ) {
        $this->stateGenerator = $stateGenerator;
    }

    public function interact(BuildDiscordOAuthRequest $request): BuildDiscordOAuthResponse
    {
        $state = $this->stateGenerator->generate();

        $discordAuthParams = [
            'response_type' => 'code',
            'client_id' => $request->getClientId(),
            'scope' => implode(' ', $request->getScopes()),
            'state' => $state,
            'redirect_url' => $request->getRedirectUrl(),
            'prompt' => 'consent'
        ];
        $query = http_build_query($discordAuthParams);

        return new BuildDiscordOAuthResponse(
            self::DISCORD_OAUTH_URL . '?' . $query,
            $state
        );
    }
}
