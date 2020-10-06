<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusRequest;
use Ome\Event\UseCases\GetMarathonFromOengusInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery\MockOengusMarathonQuery;

class GetMarathonFromOengusInteractorTest extends TestCase
{
    /** @test */
    public function testGetMarathonFromOengus()
    {
        $mockOengusMarathonQuery = new MockOengusMarathonQuery;
        $result = (new GetMarathonFromOengusInteractor($mockOengusMarathonQuery))->interact(
            new GetMarathonFromOengusRequest('id')
        );

        $this->assertEquals($mockOengusMarathonQuery->fetch('id', Carbon::now()), $result->getOengusMarathon());
    }
}
