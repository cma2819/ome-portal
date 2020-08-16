<?php

namespace App\Domain\Twitter\Commands;

use App\Domain\Twitter\TwitterErrorHandler;
use App\Exceptions\Twitter\TooLargeUploadedFileException;
use CURLFile;
use mpyw\Cowitter\Client;
use mpyw\Cowitter\HttpException;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand;

class TwitterPersistTwitterMediaCommand implements PersistTwitterMediaCommand
{
    use TwitterErrorHandler;

    protected Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function execute(TwitterMedia $input): string
    {
        $endpoint = 'media/upload';
        $parameters = [
            'media' => new CURLFile($input->getMediaUrl())
        ];

        try {
            $response = $this->client->post($endpoint, $parameters);
        } catch (HttpException $e) {
            if ($e->getStatusCode() === 413) {
                throw new TooLargeUploadedFileException($e->getMessage());
            }
            throw $e;
        }
        return $response->media_id_string;
    }
}
