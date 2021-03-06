<?php

namespace App\Api\Discord;

use App\Facades\Logger;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DiscordApiClient
{
    private ClientInterface $client;

    private string $botToken;

    private int $cacheExpire;

    public function __construct(
        ClientInterface $client,
        string $botToken,
        int $cacheExpire
    ) {
        $this->client = $client;
        $this->botToken = $botToken;
        $this->cacheExpire = $cacheExpire;
    }

    public function apiGet(string $endpoint): array
    {
        $cacheKey = "discord.get.${endpoint}";
        if (Cache::has($cacheKey)) {
            $data = Cache::get($cacheKey);
            if (is_array($data)) {
                return $data;
            }
        };

        Logger::debug('string', 'Api.Discord', 'Get request with Discord API Client to [{url}].', ['endpoint' => $endpoint]);
        try {
            $response = $this->client->request('GET', $endpoint, [
                'headers' => [
                    'Authorization' => "Bot {$this->botToken}",
                ],
            ]);
        } catch (ClientException $e) {
            throw new DiscordHttpException($e->getCode(), 'Failed to get request to endpoint[' . $endpoint . '].');
        }

        $data = json_decode($response->getBody(), true);
        if (is_null($data)) {
            throw new DiscordHttpException($response->getStatusCode(), 'Cannot parse response body to json.', null, $response->getBody());
        }
        Cache::set($cacheKey, $data, $this->cacheExpire);

        return $data;
    }

    public function apiPost(string $endpoint, array $parameters): array
    {
        Logger::debug('string', 'Api.Discord', 'Post request with Discord API Client to [{url}].', ['endpoint' => $endpoint]);
        try {
            $response = $this->client->request('POST', $endpoint, [
                'json' => $parameters,
                'headers' => [
                    'Authorization' => "Bot {$this->botToken}",
                ],
            ]);
        } catch (ClientException $e) {
            Logger::debug('string', 'Api.Discord', 'Failed to post request to discord api with status:' . $e->getCode());
            throw new DiscordHttpException($e->getCode(), 'Failed to get request to endpoint[' . $endpoint . '].');
        }

        $data = json_decode($response->getBody(), true);
        return $data;
    }
}
