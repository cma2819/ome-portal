<?php

namespace Ome\Auth\UseCases;

use AuthDiscord\AuthDiscord;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthResponse;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;
use Ome\OAuth\Interfaces\OAuthStateGenerator;

class BuildDiscordOAuthInteractor implements BuildDiscordOAuthUseCase
{
    public const DISCORD_OAUTH_URL = 'https://discord.com/api/oauth2/authorize';

    protected OAuthStateGenerator $stateGenerator;

    protected AuthDiscord $authDiscord;

    public function __construct(
        OAuthStateGenerator $stateGenerator,
        AuthDiscord $authDiscord
    ) {
        $this->stateGenerator = $stateGenerator;
        $this->authDiscord = $authDiscord;
    }

    public function interact(BuildDiscordOAuthRequest $request): BuildDiscordOAuthResponse
    {
        $state = $this->stateGenerator->generate();

        $oAuthUri = $this->authDiscord->buildDiscordOAuthUri(
            $state,
            $request->getRedirectUrl(),
            $request->getScopes()
        );

        return new BuildDiscordOAuthResponse(
            $oAuthUri,
            $state
        );
    }
}
