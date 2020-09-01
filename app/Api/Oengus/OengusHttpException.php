<?php

namespace App\Api\Oengus;

use App\Exceptions\HttpStatusThrowable;
use RuntimeException;
use Throwable;

class OengusHttpException extends RuntimeException implements HttpStatusThrowable
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
