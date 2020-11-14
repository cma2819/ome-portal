<?php

namespace Ome\Exceptions;

use Exception;

/**
 * Runtime Exception when Entity about to be created unmatched on domain context.
 */
class UnmatchedContextException extends Exception
{
    public function __construct(
        string $className,
        string $message
    ) {
        parent::__construct(
            $className . ': ' . $message
        );
    }
}
