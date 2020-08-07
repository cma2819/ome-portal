<?php

namespace Ome\Exceptions;

use RuntimeException;

/**
 * Runtime Exception when Entity about to be created unmatched on domain context.
 */
class UnmatchedContextException extends RuntimeException
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
