<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ome\Event\Values\MarathonStatus;
use Tests\TestCase;

class EventShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testEventShow()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'R1KONLINE',
            'startAt' => Carbon::make('2020-03-07T01:00:07Z')->toISOString(),
            'endAt' => Carbon::make('2020-03-08T13:48:07Z')->toISOString(),
            'submitsOpen' => false,
            'status' => MarathonStatus::closed()->value()
        ]);
        $response = $this->getJson(route('api.v1.events.show', ['event' => 'rtamarathon']));

        $response->assertSuccessful();
        $response->assertJson([
            'id' => 'rtamarathon',
            'relateType' => 'moderate',
            'slug' => 'R1KONLINE',
            'startAt' => Carbon::make('2020-03-07T01:00:07Z')->toISOString(),
            'endAt' => Carbon::make('2020-03-08T13:48:07Z')->toISOString(),
            'submitsOpen' => false,
            'status' => MarathonStatus::closed()->value()
        ]);
    }

    /** @test */
    public function testEventNotFound()
    {
        $response = $this->getJson(route('api.v1.events.show', ['event' => 'rtamarathon']));

        $response->assertNotFound();
    }


}
