<?php

namespace App\Infrastructure\Queries\Stream;

use App\Api\Twitch\TwitchApiClient;
use Ome\Stream\Interfaces\Queries\GetTwitchUserIdFromAccessTokenQuery;

class ApiGetTwitchUserIdFromAccessToken implements GetTwitchUserIdFromAccessTokenQuery
{
    private TwitchApiClient $apiClient;

    public function __construct(
        TwitchApiClient $apiClient
    ) {
        $this->apiClient = $apiClient;
    }

    public function fetch(string $accessToken): string
    {
        $json = $this->apiClient->apiIdentifyGet('/oauth2/validate', $accessToken);

        return $json['user_id'];
    }
}
