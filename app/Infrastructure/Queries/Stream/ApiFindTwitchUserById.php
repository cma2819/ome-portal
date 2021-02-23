<?php

namespace App\Infrastructure\Queries\Stream;

use App\Api\Twitch\TwitchApiClient;
use Ome\Stream\Entities\TwitchUser;
use Ome\Stream\Interfaces\Queries\FindTwitchUserByIdQuery;

class ApiFindTwitchUserById implements FindTwitchUserByIdQuery
{
    private TwitchApiClient $apiClient;

    public function __construct(
        TwitchApiClient $apiClient
    ) {
        $this->apiClient = $apiClient;
    }

    public function fetch(string $userId, string $bearer): ?TwitchUser
    {
        $endpoint = '/users?id=' . $userId;

        $json = $this->apiClient->apiGet($endpoint, $bearer);
        if (!array_key_exists('data', $json) || empty($json['data'])) {
            return null;
        }

        return TwitchUser::createFromJson($json['data'][0]);
    }
}
