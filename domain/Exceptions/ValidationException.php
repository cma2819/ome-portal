<?php

namespace Ome\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    public function __construct(
        string $property,
        string $error,
        Throwable $previous = null
    ) {
        parent::__construct(
            $property . ' must be ' . $error,
            0,
            $previous
        );
    }
}
