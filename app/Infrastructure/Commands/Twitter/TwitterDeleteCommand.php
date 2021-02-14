<?php

namespace App\Infrastructure\Commands\Twitter;

use App\Domain\Twitter\TwitterErrorHandler;
use mpyw\Cowitter\Client;
use mpyw\Cowitter\HttpException;
use Ome\Twitter\Interfaces\Commands\DeleteTweetCommand;

class TwitterDeleteTweetCommand implements DeleteTweetCommand
{
    use TwitterErrorHandler;

    protected Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function execute(string $id): bool
    {
        $endpoint = 'statuses/destroy';
        $parameter = [
            'id' => $id
        ];
        try {
            $status = $this->client->post($endpoint, $parameter);
            // Make successful response if api response includes tweet id
            if (isset($status->id)) {
                return true;
            }
        } catch (HttpException $e) {
            $this->handleError($e);
            return false;
        }

        return false;
    }
}
