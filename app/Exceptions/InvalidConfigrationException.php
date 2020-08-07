<?php

namespace App\Exceptions;

use RuntimeException;
use Throwable;

class InvalidConfigurationException extends RuntimeException
{
    public function __construct(
        string $key,
        $value,
        Throwable $previous = null
    ) {
        parent::__construct(
            "Configuration for [{$key}={$value}] is invalid.",
            0,
            $previous
        );
    }
}
