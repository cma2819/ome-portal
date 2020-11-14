<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Support\Str;

trait HasApiToken
{
    /**
     * Refresh api token.
     *
     * @return string api token as plain text.
     */
    public function refreshToken(): string
    {
        $token = Str::random(64);
        $this->api_token = $token;

        return $token;
    }
}
