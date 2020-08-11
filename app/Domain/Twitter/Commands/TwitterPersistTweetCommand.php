<?php

namespace App\Domain\Twitter\Commands;

use App\Domain\Twitter\TwitterErrorHandler;
use App\Exceptions\Twitter\TwitterValidationException;
use mpyw\Cowitter\Client;
use mpyw\Cowitter\HttpException;
use mpyw\Cowitter\Response;
use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTweetCommand;
use Ome\Twitter\Interfaces\Dto\TweetDto;

class TwitterPersistTweetCommand implements PersistTweetCommand
{
    use TwitterErrorHandler;

    protected Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function execute(Tweet $input): TweetDto
    {
        $endpoint = 'statuses/update';
        $parameter = [
            'status' => $input->getText(),
            'media_ids' => implode(',', $input->getMediaIds())
        ];

        try {
            /** @var Response */
            $response = $this->client->post($endpoint, $parameter, true);
        } catch (HttpException $e) {
            $this->handleError($e);
            if ($e->getStatusCode() === 403) {
                throw new TwitterValidationException($e->getMessage());
            }
        }
        $responseJson = json_decode($response->getRawContent(), true);
        $tweet = Tweet::createFromApiJson($responseJson);
        $medias = TwitterMedia::createMediasFromTweetApiJson($responseJson);

        return new TweetDto($tweet, $medias);
    }
}
