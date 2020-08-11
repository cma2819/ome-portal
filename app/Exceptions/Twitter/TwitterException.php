<?php

namespace App\Exceptions\Twitter;

interface TwitterException
{
    public function getStatusCode(): int;
}
