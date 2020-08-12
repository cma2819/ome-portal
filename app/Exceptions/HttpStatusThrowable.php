<?php

namespace App\Exceptions;

interface HttpStatusThrowable
{
    public function getStatusCode(): int;
}
