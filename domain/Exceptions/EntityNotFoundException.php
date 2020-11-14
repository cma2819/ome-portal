<?php

namespace Ome\Exceptions;

use Exception;

/**
 * Runtime Exception in case of that not found entity.
 */
class EntityNotFoundException extends Exception
{
    public function __construct(
        string $className,
        array $attribute
    ) {
        $jsonAttribute = json_encode($attribute);

        parent::__construct(
            "Entity [${className}] was not found in attribute: ${jsonAttribute}"
        );
    }
}
