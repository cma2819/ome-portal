<?php

namespace Ome\OAuth;

use Ome\OAuth\Interfaces\OAuthStateGenerator;

class OAuthStateRandomGenerator implements OAuthStateGenerator
{
    public function generate(): string
    {
        return hash('sha256', uniqid());
    }
}
