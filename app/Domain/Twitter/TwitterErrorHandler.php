<?php

namespace App\Domain\Twitter;

use App\Exceptions\Twitter\ApiRateLimitException;
use mpyw\Cowitter\HttpExceptionInterface;

trait TwitterErrorHandler
{
    /**
     * Call Twitter Api with indexed array params.
     *
     * @param callable $apiCall
     * @param array $params
     * @return void
     */
    public function handleError(HttpExceptionInterface $e)
    {
        if ($e->getStatusCode() === 429) {
            throw new ApiRateLimitException($e->getResponse()->getRawContent());
        }
        return;
    }
}
