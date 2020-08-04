<?php

namespace Ome\Twitter\Interfaces\Dto;

use DateTimeInterface;

class TweetDto
{
    protected int $id;

    protected string $text;

    /** @var TwitterMedia[] */
    protected array $medias;

    protected DateTimeInterface $createdAt;


    public function __construct(
        int $id,
        string $text,
        array $medias,
        DateTimeInterface $createdAt
    )
    {
        $this->id = $id;
        $this->text = $text;
        $this->medias = $medias;
        $this->createdAt = $createdAt;
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
