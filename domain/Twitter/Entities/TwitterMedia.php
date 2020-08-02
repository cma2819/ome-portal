<?php

namespace Ome\Twitter\Entities;

use JsonSerializable;
use Ome\Twitter\Values\TwitterMediaType;

class TwitterMedia implements JsonSerializable
{

    protected int $id;

    protected string $mediaUrl;

    protected TwitterMediaType $type;

    protected function __construct(
        int $id,
        string $mediaUrl,
        TwitterMediaType $type
    )
    {
        $this->id = $id;
        $this->mediaUrl = $mediaUrl;
        $this->type = $type;
    }

    public static function createFromApiJson(array $json): self
    {
        return new self(
            $json['id'],
            $json['media_url_https'],
            TwitterMediaType::create($json['type'])
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'mediaUrl' => $this->mediaUrl,
            'type' => $this->type->value()
        ];
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of mediaUrl
     */
    public function getMediaUrl()
    {
        return $this->mediaUrl;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }
}
