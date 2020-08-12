<?php

namespace App\Exceptions\Discord;

use App\Exceptions\HttpStatusThrowable;
use RuntimeException;
use Throwable;

class AuthenticationFailedException extends RuntimeException implements HttpStatusThrowable
{
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 401, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
