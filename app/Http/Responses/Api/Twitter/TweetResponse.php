<?php

namespace App\Http\Responses\Api\Twitter;

use Carbon\Carbon;
use JsonSerializable;
use Ome\Twitter\Interfaces\Dto\TweetDto;

class TweetResponse implements JsonSerializable
{
    private array $json;

    public function __construct(TweetDto $tweetDto)
    {
        $tweet = $tweetDto->getTweet();
        $medias = $tweetDto->getMedias();
        $mediasJson = [];
        foreach ($medias as $media) {
            $mediasJson[] = (new TwitterMediaResponse($media))->jsonSerialize();
        }

        $this->json = [
            'id' => $tweet->getId(),
            'text' => $tweet->getText(),
            'medias' => $mediasJson,
            'createdAt' => Carbon::make($tweet->getCreatedAt())->toISOString()
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}
