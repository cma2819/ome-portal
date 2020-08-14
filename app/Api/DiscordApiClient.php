<?php

namespace App\Api;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiscordApiClient
{
    private string $apiUrl;

    private string $botToken;

    public function __construct(
        string $apiUrl,
        string $botToken
    ) {
        $this->apiUrl = $apiUrl;
        $this->botToken = $botToken;

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
        Log::debug('Get request with Discord API Client to [' . $url . '].');
        $response = Http::withToken($this->botToken, 'Bot')->get($url);
        if ($response->failed()) {
            Log::debug('Failed to get request to discord api with status:' . $response->status());
            throw new DiscordHttpException($response->status(), 'Failed to get request to endpoint[' . $endpoint . '].');
        }

        $data = json_decode($response->body(), true);
        Cache::set($cacheKey, $data, 30);

        return $data;
    }
}
