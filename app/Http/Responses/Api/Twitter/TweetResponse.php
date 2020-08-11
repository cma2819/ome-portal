<?php

namespace App\Http\Responses\Api\Twitter;

use Carbon\Carbon;
use JsonSerializable;
use Ome\Twitter\Interfaces\Dto\TweetDto;

class TweetResponse implements JsonSerializable
{
    private TweetDto $tweetDto;

    public function __construct(TweetDto $tweetDto)
    {
        $this->tweetDto = $tweetDto;
    }

    public function jsonSerialize()
    {
        $tweet = $this->tweetDto->getTweet();
        $medias = $this->tweetDto->getMedias();
        $mediasJson = [];
        foreach ($medias as $media) {
            $mediasJson[] = (new TwitterMediaResponse($media))->jsonSerialize();
        }

        return [
            'id' => $tweet->getId(),
            'text' => $tweet->getText(),
            'medias' => $mediasJson,
            'createdAt' => Carbon::make($tweet->getCreatedAt())->toISOString()
        ];
    }
}
