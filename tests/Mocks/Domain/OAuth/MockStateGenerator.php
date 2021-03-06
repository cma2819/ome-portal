<?php

namespace Tests\Mocks\Domain\OAuth;

use Ome\OAuth\Interfaces\OAuthStateGenerator;

class MockStateGenerator implements OAuthStateGenerator
{
    private string $mock;

    public function __construct(
        string $mock
    ) {
        $this->mock = $mock;
    }

    public function generate(): string
    {
        return $this->mock;
    }

    /**
     * Get the value of mock
     */
    public function getMock()
    {
        return $this->mock;
    }
}
