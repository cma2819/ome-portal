<?php

namespace Ome\Twitter\Entities;

use Ome\Twitter\Values\TwitterMediaType;

class PartialTwitterMedia extends TwitterMedia
{
    public static function createPartial(
        int $id,
        string $mediaUrl,
        TwitterMediaType $type
    ) {
        return new self($id, $mediaUrl, $type);
    }
}
