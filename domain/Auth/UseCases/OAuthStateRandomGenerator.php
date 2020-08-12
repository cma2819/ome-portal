<?php

namespace Ome\Auth\UseCases;

use Ome\Auth\Interfaces\OAuthStateGenerator;

class OAuthStateRandomGenerator implements OAuthStateGenerator
{
    public function generate(): string
    {
        return hash('sha256', uniqid());
    }
}
