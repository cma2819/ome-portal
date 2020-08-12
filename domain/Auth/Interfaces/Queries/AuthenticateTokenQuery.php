<?php

namespace Ome\Auth\Interfaces\Queries;

interface AuthenticateTokenQuery
{
    public function fetch(
        string $clientId,
        string $clientSecret,
        string $code,
        string $redirectUrl,
        array $scopes
    ): string;
}
