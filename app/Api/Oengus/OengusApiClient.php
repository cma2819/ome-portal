<?php

namespace App\Api\Oengus;

use App\Facades\Logger;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OengusApiClient
{
    private string $apiUrl;

    private int $cacheExpire;

    public function __construct(
        string $apiUrl,
        int $cacheExpire
    ) {
        $this->apiUrl = $apiUrl;
        $this->cacheExpire = $cacheExpire;

        if (substr($this->apiUrl, -1, 1) === '/') {
            $this->apiUrl = substr($this->apiUrl, 0, -1);
        }
    }

    public function apiGet(string $endpoint): array
    {
        $cacheKey = "oengus.get.${endpoint}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        };

        $url = $this->apiUrl . $endpoint;
        Logger::debug('string', 'Api.Oengus', 'Get request with Oengus API Client to [{url}].', ['url' => $url]);

        $response = Http::get($url);
        if ($response->failed()) {
            Logger::debug('string', 'Api.Oengus', 'Failed to get request to oengus api with status:' . $response->status());
            throw new OengusHttpException($response->status(), 'Failed to get request to endpoint[' . $endpoint . '].');
        }

        $data = json_decode($response->body(), true);
        Cache::set($cacheKey, $data, $this->cacheExpire);

        return $data;
    }
}
