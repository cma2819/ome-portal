<?php

namespace App\Api\Discord;

use App\Exceptions\HttpStatusThrowable;
use RuntimeException;
use Throwable;

class DiscordHttpException extends RuntimeException implements HttpStatusThrowable
{
    private ?string $body;

    public function __construct(
        int $status,
        string $message,
        Throwable $previous = null,
        ?string $body = null
    ) {
        parent::__construct($message, $status, $previous);

        $this->body = $body;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getBody()
    {
        return $this->body;
    }
}
