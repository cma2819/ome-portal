<?php

namespace Tests\Feature\Api\Events;

use App\Eloquents\AssociateEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;
use Ome\Event\Values\MarathonStatus;
use Tests\AssertJsonArray;
use Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery\MockOengusMarathonQuery;
use Tests\TestCase;

class EventActiveTest extends TestCase
{
    use RefreshDatabase;
    use AssertJsonArray;

    /** @test */
    public function testEventWhenActive()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);

        Carbon::setTestNow(Carbon::create(2020, 3, 8));
        $this->app->bind(OengusMarathonQuery::class, function () {
            return new MockOengusMarathonQuery(__DIR__ . '/oengusMarathon.json');
        });

        $response = $this->getJson(route('api.v1.events.index.active'));

        $response->assertSuccessful();
        $response->assertJson([
            [
                'id' => 'rtamarathon',
                'name' => 'RTA 1n Kagawa Online',
                'relateType' => 'moderate',
                'slug' => 'RM1',
                'startAt' => Carbon::make('2020-03-07T01:00:07Z')->toISOString(),
                'endAt' => Carbon::make('2020-03-08T13:48:07Z')->toISOString(),
                'submitsOpen' => false,
                'status' => MarathonStatus::scheduled()->value()
            ],
        ]);
    }

    /** @test */
    public function testEventWhenNothing()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);

        Carbon::setTestNow(Carbon::create(2020, 3, 11));
        $this->app->bind(OengusMarathonQuery::class, function () {
            return new MockOengusMarathonQuery(__DIR__ . '/oengusMarathon.json');
        });

        $response = $this->getJson(route('api.v1.events.index.active'));

        $response->assertSuccessful();
        $response->assertJson([]);
    }

}
