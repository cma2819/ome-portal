<?php

namespace Tests\Feature\Api\Events;

use App\Eloquents\AssociateEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ome\Event\Values\MarathonStatus;
use Tests\AssertJsonArray;
use Tests\TestCase;

class EventIndexTest extends TestCase
{
    use RefreshDatabase;
    use AssertJsonArray;

    /** @test */
    public function testEventIndex()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);
        AssociateEvent::create([
            'id' => 'rtamarathon2',
            'relate_type' => 'support',
            'slug' => 'RM2'
        ]);

        $response = $this->getJson(route('api.v1.events.index'));

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
                'status' => MarathonStatus::closed()->value()
            ],
            [
                'id' => 'rtamarathon2',
                'name' => 'RTA 1n Kagawa Online',
                'relateType' => 'support',
                'slug' => 'RM2',
                'startAt' => Carbon::make('2020-03-07T01:00:07Z')->toISOString(),
                'endAt' => Carbon::make('2020-03-08T13:48:07Z')->toISOString(),
                'submitsOpen' => false,
                'status' => MarathonStatus::closed()->value()
            ]
        ]);
    }

}
