<?php

namespace App\Http\Responses\Api\Errors;

use App\Http\Responses\Api\ErrorResponse;

class UnauthorizedErrorResponse extends ErrorResponse
{
    public function __construct()
    {
        parent::__construct('User is not authorized.');
    }
}
