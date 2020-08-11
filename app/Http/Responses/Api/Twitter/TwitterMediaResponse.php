<?php

namespace App\Http\Responses\Api\Twitter;

use JsonSerializable;
use Ome\Twitter\Entities\TwitterMedia;

class TwitterMediaResponse implements JsonSerializable
{
    private TwitterMedia $media;

    public function __construct(
        TwitterMedia $media
    )
    {
        $this->media = $media;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->media->getId(),
            'mediaUrl' => $this->media->getMediaUrl(),
            'type' => $this->media->getType()->value()
        ];
    }
}
