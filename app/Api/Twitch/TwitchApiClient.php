<?php

namespace App\Api\Twitch;

use App\Facades\Logger;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TwitchApiClient
{
    private string $clientId;

    private string $clientSecret;

    private string $apiUrl;

    private string $identifyApiUrl;

    private int $cacheExpire;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $apiUrl,
        string $identifyApiUrl,
        int $cacheExpire
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->apiUrl = $apiUrl;
        $this->identifyApiUrl = $identifyApiUrl;
        $this->cacheExpire = $cacheExpire;

        if (substr($this->apiUrl, -1, 1) === '/') {
            $this->apiUrl = substr($this->apiUrl, 0, -1);
        }
        if (substr($this->identifyApiUrl, -1, 1) === '/') {
            $this->identifyApiUrl = substr($this->identifyApiUrl, 0, -1);
        }
    }

    public function apiGet(string $endpoint, ?string $bearer = null): array
    {
        if (is_null($bearer)) {
            $bearer = $this->getClientCredentials();
        }
        $cacheKey = "twitch.get.{$endpoint}_{$bearer}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        };

        $url = $this->apiUrl . $endpoint;
        $data = $this->_get($url, $bearer);
        Cache::set($cacheKey, $data, $this->cacheExpire);

        return $data;
    }

    public function apiPost(string $endpoint, array $data, ?string $bearer = null): array
    {
        if (is_null($bearer)) {
            $bearer = $this->getClientCredentials();
        }
        $url = $this->apiUrl . $endpoint;
        $response = $this->_post($url, $data, $bearer);

        return $response;
    }

    public function apiIdentifyGet(string $endpoint, ?string $bearer = null): array
    {
        $url = $this->identifyApiUrl . $endpoint;
        $data = $this->_get($url, $bearer);

        return $data;
    }

    public function apiIdentifyPost(string $endpoint, array $data, ?string $bearer = null): array
    {
        $url = $this->identifyApiUrl . $endpoint;
        $response = $this->_post($url, $data);

        return $response;
    }

    private function getClientCredentials(): string
    {
        $cacheKey = 'twitch_client_credentials';
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        $query = http_build_query([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials',
            'scope' => 'user:read:email',
        ]);

        $response = $this->apiIdentifyPost('/oauth2/token?' . $query, []);

        Cache::set($cacheKey, $response['access_token'], $response['expires_in']);
        return $response['access_token'];
    }

    private function _get(string $url, ?string $bearer = null): array
    {
        Logger::debug('string', 'Api.Twitch', 'Get request with Twitch API Client to [{url}].', ['url' => $url]);

        $response = Http::withHeaders([
            'client-id' => $this->clientId,
        ])->withToken($bearer)->get($url);
        if ($response->failed()) {
            Logger::debug('string', 'Api.Twitch', 'Failed to get request to Twitch API with status:' . $response->status());
            Logger::debug('json', 'Api.Twitch', json_encode($response->body()));
            throw new TwitchHttpException($response->status(), 'Failed to get request to ' . $url . '.');
        }

        $data = json_decode($response->body(), true);
        return $data;
    }

    private function _post(string $url, array $data, ?string $bearer = null): array
    {
        Logger::debug('string', 'Api.Twitch', 'Post request with Twitch API Client to [{url}].', ['url' => $url]);
        Logger::debug('json', 'Api.Twitch', json_encode($data));

        $response = Http::withHeaders([
            'client-id' => $this->clientId,
        ])->withToken($bearer)->post($url, $data);
        if ($response->failed()) {
            Logger::debug('string', 'Api.Twitch', 'Failed to post request to Twitch API with status:' . $response->status());
            Logger::debug('json', 'Api.Twitch', json_encode($response->body()));
            throw new TwitchHttpException($response->status(), 'Failed to post request to ' . $url . '.');
        }

        $data = json_decode($response->body(), true);
        return $data;
    }
}
