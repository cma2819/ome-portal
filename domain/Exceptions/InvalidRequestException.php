<?php

namespace Ome\Exceptions;

use Exception;

/**
 * Runtime Exception in case of that not found entity.
 */
class InvalidRequestException extends Exception
{
    public function __construct(
        array $attributes
    ) {
        $messages = [];

        foreach ($attributes as $key => $attribute) {
            $messages[] = "{$attribute} is invalid for request:{$key}.";
        }

        parent::__construct(implode(PHP_EOL, $messages));
    }
}
