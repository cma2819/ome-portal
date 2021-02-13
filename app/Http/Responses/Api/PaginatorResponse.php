<?php

namespace App\Http\Responses\Api;

use JsonSerializable;

class PaginatorResponse implements JsonSerializable
{
    private array $json;

    /**
     * @param integer $current
     * @param boolean $hasNext
     * @param JsonSerializable[] $data
     */
    public function __construct(
        int $current,
        bool $hasNext,
        array $data
    ) {
        $prev = $current !== 0 ? $current - 1 : null;
        $next = $hasNext ? $current + 1 : null;

        $this->json = [
            'prev' => $prev,
            'current' => $current,
            'next' => $next,
            'data' => $data,
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}
