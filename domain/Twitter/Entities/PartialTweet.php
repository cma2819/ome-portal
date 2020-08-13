<?php

namespace Ome\Twitter\Entities;

use DateTimeInterface;

class PartialTweet extends Tweet
{
    public static function createPartial(
        string $id,
        string $text,
        array $medias,
        DateTimeInterface $createdAt
    ): Tweet {
        return new parent($id, $text, $medias, $createdAt);
    }
}
