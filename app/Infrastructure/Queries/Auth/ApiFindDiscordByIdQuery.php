<?php

namespace App\Infrastructure\Queries\Auth;

use App\Api\Discord\DiscordApiClient;
use App\Api\Discord\DiscordHttpException;
use App\Facades\Logger;
use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Interfaces\Queries\FindDiscordByIdQuery;

class ApiFindDiscordByIdQuery implements FindDiscordByIdQuery
{
    private DiscordApiClient $client;

    public function __construct(
        DiscordApiClient $client
    ) {
        $this->client = $client;
    }

    public function fetch(string $id): ?DiscordUser
    {
        $endpoint = 'users/' . $id;

        try {
            $userJson = $this->client->apiGet($endpoint);
        } catch (DiscordHttpException $e) {
            Logger::warning('string', 'Command.ApiFindDiscordById', $e->getMessage());
            Logger::warning('json', 'Command.ApiFindDiscordById', $e->getBody());
            return null;
        }

        return DiscordUser::createFromApiJson($userJson);
    }
}
