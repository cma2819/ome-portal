<?php

namespace Ome\Twitter\Entities;

use DateTime;
use DateTimeInterface;
use JsonSerializable;
use Ome\Exceptions\UnmatchedContextException;

class Tweet implements JsonSerializable
{
    protected ?string $id;

    protected string $text;

    /** @var string[] */
    protected array $mediaIds;

    protected ?DateTimeInterface $createdAt;

    /**
     * @param string $id
     * @param string $text Not validate in application because tweet character counting is complex. Twitter will validate this.
     * @param string[] $mediaIds
     * @param DateTimeInterface $createdAt
     */
    protected function __construct(
        ?string $id,
        string $text,
        array $mediaIds,
        ?DateTimeInterface $createdAt
    ) {
        if (count($mediaIds) > 4) {
            throw new UnmatchedContextException(
                self::class,
                'Tweet has max 4 medias. ' . count($mediaIds) . ' medias received.'
            );
        }
        $this->id = $id;
        $this->text = $text;
        $this->mediaIds = $mediaIds;
        $this->createdAt = $createdAt;
    }

    public static function createNewTweet(
        string $text,
        array $mediaIds
    ) {
        return new self(null, $text, $mediaIds, null);
    }

    public static function createFromApiJson(array $json): self
    {
        $mediaIds = [];
        if (array_key_exists('extended_entities', $json)) {
            $mediaArrayJson = $json['extended_entities']['media'];

            foreach ($mediaArrayJson as $mediaJson) {
                $mediaIds[] = $mediaJson['id'];
            }
        }
        return new self(
            $json['id'],
            $json['text'],
            $mediaIds,
            new DateTime($json['created_at'])
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'medias' => $this->mediaIds,
            'createdAt' => $this->createdAt->format('c')
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
     * Get the value of text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Get the value of mediaIds
     */
    public function getMediaIds()
    {
        return $this->mediaIds;
    }
}
