<?php

namespace App\Http\Responses\Api;

use JsonSerializable;

class ErrorResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        string $message
    ) {
        $this->json = [
            'message' => $message,
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}
