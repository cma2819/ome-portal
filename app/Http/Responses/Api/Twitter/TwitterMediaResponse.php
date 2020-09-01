<?php

namespace App\Http\Responses\Api\Twitter;

use JsonSerializable;
use Ome\Twitter\Entities\TwitterMedia;

class TwitterMediaResponse implements JsonSerializable
{
    private array $json;

    private TwitterMedia $media;

    public function __construct(
        TwitterMedia $media
    ) {
        $this->json = [
            'id' => $media->getId(),
            'mediaUrl' => $media->getMediaUrl(),
            'type' => $media->getType()->value()
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}
