<?php

namespace App\Domain\Twitter\Commands;

use Illuminate\Support\Facades\Log;
use mpyw\Co\CURLException;
use mpyw\Cowitter\Client;
use mpyw\Cowitter\HttpException;
use Ome\Twitter\Interfaces\Commands\DeleteTweetCommand;

class DeleteTweet implements DeleteTweetCommand
{
    protected Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function execute(int $id): bool
    {
        $endpoint = 'statuses/destroy/' . $id;
        try {
            $status = $this->client->post($endpoint);
            // Make successful response if api response includes tweet id
            if (array_key_exists('id', $status)) {
                return true;
            }
            return false;
        } catch (HttpException $e) {
            // Not has defined Http response code, should throw Exception.
            if (!($e->getCode() >= 200 && $e->getCode() < 600)) {
                Log::error('Bad response from Twitter.');
                Log::error($e->getMessage());
                throw $e;
            }
        } catch (CURLException $e) {
            Log::error('Error happened on cURL.');
            Log::error($e->getMessage());
        }

        return false;
    }
}
