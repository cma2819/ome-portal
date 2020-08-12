<?php

namespace Ome\Auth\Interfaces;

interface OAuthStateGenerator
{
    /**
     * Generate OAuth state value.
     *
     * @return string
     */
    public function generate(): string;
}
