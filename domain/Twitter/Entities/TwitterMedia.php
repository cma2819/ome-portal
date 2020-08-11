<?php

namespace Ome\Twitter\Entities;

use JsonSerializable;
use Ome\Exceptions\UnmatchedContextException;
use Ome\Twitter\Values\TwitterMediaType;
use Psr\Http\Message\UploadedFileInterface;

class TwitterMedia implements JsonSerializable
{
    protected ?string $id;

    /**
     * Local file path when ID is null, Uploaded URL when ID is not null (it means already uploaded twitter).
     */
    protected string $mediaUrl;

    protected TwitterMediaType $type;

    protected function __construct(
        ?string $id,
        string $mediaUrl,
        TwitterMediaType $type
    ) {
        $this->id = $id;
        $this->mediaUrl = $mediaUrl;
        $this->type = $type;
    }

    public static function createUploadMedia(string $mediaUrl, string $mime): self
    {
        switch ($mime) {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
            $type = TwitterMediaType::photo();
            break;
        case 'video/mp4':
            $type = TwitterMediaType::video();
            // no break
        default:
            throw new UnmatchedContextException(
                self::class,
                'Client media type not match. Received type is ' . $mime . '.'
            );
        }

        return new self(
            null,
            $mediaUrl,
            $type
        );
    }

    public static function createFromApiJson(array $json): self
    {
        return new self(
            $json['id'],
            $json['media_url_https'],
            TwitterMediaType::create($json['type'])
        );
    }

    /**
     * Create medias from tweet api response.
     *
     * @param array $json
     * @return self[]
     */
    public static function createMediasFromTweetApiJson(array $json): array
    {
        if (!array_key_exists('extended_entities', $json)) {
            return [];
        }
        $mediaArrayJson = $json['extended_entities']['media'];
        $medias = [];
        foreach ($mediaArrayJson as $mediaJson) {
            $medias[] = self::createFromApiJson($mediaJson);
        }
        return $medias;
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
