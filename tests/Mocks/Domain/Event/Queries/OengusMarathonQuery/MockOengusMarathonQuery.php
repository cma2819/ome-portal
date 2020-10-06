<?php

namespace Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery;

use Ome\Event\Entities\OengusMarathon;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;

class MockOengusMarathonQuery implements OengusMarathonQuery
{
    private array $json;

    public function __construct(?string $jsonFile = null)
    {
        if (is_null($jsonFile)) {
            $jsonFile = __DIR__ . '/default.json';
        }
        $this->json = json_decode(file_get_contents($jsonFile), true);
    }

    public function fetch(string $id): OengusMarathon
    {
        return OengusMarathon::createFromApiJson(array_replace($this->json, ['id' => $id]));
    }
}
