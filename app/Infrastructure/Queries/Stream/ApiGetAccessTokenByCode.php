<?php

namespace App\Infrastructure\Queries\Stream;

use App\Api\Twitch\TwitchApiClient;
use Ome\Stream\Interfaces\Dto\TwitchAccessTokens;
use Ome\Stream\Interfaces\Queries\GetAccessTokenByCodeQuery;

class ApiGetAccessTokenByCode implements GetAccessTokenByCodeQuery
{
    private TwitchApiClient $apiClient;

    public function __construct(
        TwitchApiClient $apiClient
    ) {
        $this->apiClient = $apiClient;
    }

    public function fetch(string $clientId, string $clientSecret, string $code, string $redirectUri): TwitchAccessTokens
    {
        $query = http_build_query([
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirectUri,
        ]);

        $json = $this->apiClient->apiIdentifyPost('/oauth2/token?' . $query, []);

        return new TwitchAccessTokens(
            $json['access_token'],
            $json['scope']
        );
    }
}
