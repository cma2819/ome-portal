<?php

namespace Ome\Stream\UseCases;

use Ome\OAuth\Interfaces\OAuthStateGenerator;
use Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthRequest;
use Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthResponse;
use Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthUseCase;

class BuildTwitchOAuthInteractor implements BuildTwitchOAuthUseCase
{
    protected const TWITCH_OAUTH_URL = 'https://id.twitch.tv/oauth2/authorize';

    protected OAuthStateGenerator $stateGenerator;

    public function __construct(
        OAuthStateGenerator $stateGenerator
    ) {
        $this->stateGenerator = $stateGenerator;
    }

    public function interact(BuildTwitchOAuthRequest $request): BuildTwitchOAuthResponse
    {
        $state = $this->stateGenerator->generate();

        $twitchOAuthParameters = [
            'client_id' => $request->getClientId(),
            'redirect_uri' => $request->getRedirectUri(),
            'response_type' => 'code',
            'scope' => implode(' ', $request->getScopes()),
            'force_verify' => 'true',
            'state' => $state,
        ];
        $query = http_build_query($twitchOAuthParameters);

        return new BuildTwitchOAuthResponse(
            self::TWITCH_OAUTH_URL . '?' . $query,
            $state
        );
    }
}
