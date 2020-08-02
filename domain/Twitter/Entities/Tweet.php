<?php

namespace Ome\Twitter\Entities;

use DateTime;
use DateTimeInterface;
use JsonSerializable;

class Tweet implements JsonSerializable
{
    protected int $id;

    protected string $text;

    protected TwitterUser $user;

    /** @var TwitterMedia[] */
    protected array $medias;

    protected DateTimeInterface $createdAt;

    /**
     * @param integer $id
     * @param string $text
     * @param TwitterUser $user
     * @param TwitterMedia[] $medias
     * @param DateTimeInterface $createdAt
     */
    protected function __construct(
        int $id,
        string $text,
        TwitterUser $user,
        array $medias,
        DateTimeInterface $createdAt
    ) {
        $this->id = $id;
        $this->text = $text;
        $this->user = $user;
        $this->medias = $medias;
        $this->createdAt = $createdAt;
    }

    public static function createFromApiJson(array $json): self
    {
        $mediaArrayJson = $json['extended_entities']['media'];
        $medias = [];

        foreach ($mediaArrayJson as $mediaJson) {
            $medias[] = TwitterMedia::createFromApiJson($mediaJson);
        }
        return new self(
            $json['id'],
            $json['text'],
            TwitterUser::createFromApiJson($json['user']),
            $medias,
            new DateTime($json['created_at'])
        );
    }

    public function jsonSerialize()
    {
        $mediaJson = [];
        foreach ($this->medias as $media) {
            $mediaJson[] = $media->jsonSerialize();
        }
        return [
            'id' => $this->id,
            'text' => $this->text,
            'user' => $this->user->jsonSerialize(),
            'medias' => $mediaJson,
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
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the value of medias
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
