<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ome\Event\Values\MarathonStatus;
use Tests\TestCase;

class EventShowLatestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testEventShowLatest()
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

        $response = $this->getJson(route('api.v1.events.latest'));

        $response->assertSuccessful();
        $response->assertJson([
            'id' => 'rtamarathon',
            'name' => 'RTA 1n Kagawa Online',
            'relateType' => 'moderate',
            'slug' => 'RM1',
            'startAt' => Carbon::make('2020-03-07T01:00:07Z')->toISOString(),
            'endAt' => Carbon::make('2020-03-08T13:48:07Z')->toISOString(),
            'submitsOpen' => false,
            'status' => MarathonStatus::closed()->value()
        ]);
    }

}
