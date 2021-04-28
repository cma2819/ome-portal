<?php

namespace Ome\Exceptions\Validations;

use Ome\Exceptions\ValidationException;
use Throwable;

class LengthValidationException extends ValidationException
{
    public function __construct(
        string $property,
        string $operation,
        int $length,
        Throwable $previous = null
    ) {
        parent::__construct(
            $property,
            $operation . $length,
            $previous
        );
    }
}
