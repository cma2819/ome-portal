<?php

namespace Ome\Twitter\Entities;

use DateTimeInterface;

class PartialTweet extends Tweet
{
    public static function createPartial(
        int $id,
        string $text,
        array $medias,
        DateTimeInterface $createdAt
    ): self {
        return new self($id, $text, $medias, $createdAt);
    }
}
