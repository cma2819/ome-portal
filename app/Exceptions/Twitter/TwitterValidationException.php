<?php

namespace App\Exceptions\Twitter;

use RuntimeException;
use Throwable;

class TwitterValidationException extends RuntimeException implements TwitterException
{
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 422, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->getCode();
    }
}
