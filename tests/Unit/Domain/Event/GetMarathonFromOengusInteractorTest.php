<?php

namespace Tests\Unit\Domain\Event;

use Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusRequest;
use Ome\Event\UseCases\GetMarathonFromOengusInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Event\Queries\MockOengusMarathonQuery;

class GetMarathonFromOengusInteractorTest extends TestCase
{
    /** @test */
    public function testGetMarathonFromOengus()
    {
        $mockOengusMarathonQuery = new MockOengusMarathonQuery;
        $result = (new GetMarathonFromOengusInteractor($mockOengusMarathonQuery))->interact(
            new GetMarathonFromOengusRequest('id')
        );

        $this->assertEquals($mockOengusMarathonQuery->fetch('id'), $result->getOengusMarathon());
    }
}
