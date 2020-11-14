<?php

namespace App\Api\Discord;

use App\Facades\Logger;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DiscordApiClient
{
    private string $apiUrl;

    private string $botToken;

    private int $cacheExpire;

    public function __construct(
        string $apiUrl,
        string $botToken,
        int $cacheExpire
    ) {
        $this->apiUrl = $apiUrl;
        $this->botToken = $botToken;
        $this->cacheExpire = $cacheExpire;

        if (substr($this->apiUrl, -1, 1) === '/') {
            $this->apiUrl = substr($this->apiUrl, 0, -1);
        }
    }

    public function apiGet(string $endpoint): array
    {
        $cacheKey = "discord.get.${endpoint}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        };

        $url = $this->apiUrl . $endpoint;
        Logger::debug('string', 'Api.Discord', 'Get request with Discord API Client to [{url}].', ['url' => $url]);
        $response = Http::withToken($this->botToken, 'Bot')->get($url);
        if ($response->failed()) {
            Logger::debug('string', 'Api.Discord', 'Failed to get request to discord api with status:' . $response->status());
            throw new DiscordHttpException($response->status(), 'Failed to get request to endpoint[' . $endpoint . '].');
        }

        $data = json_decode($response->body(), true);
        Cache::set($cacheKey, $data, $this->cacheExpire);

        return $data;
    }
}
