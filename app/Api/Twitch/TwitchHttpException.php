<?php

namespace App\Api\Twitch;

use App\Exceptions\HttpStatusThrowable;
use Exception;
use Throwable;

class TwitchHttpException extends Exception implements HttpStatusThrowable
{
    public function __construct(int $status, string $message, Throwable $previous = null)
    {
        parent::__construct($message, $status, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
