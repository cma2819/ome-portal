<?php

namespace Tests\Feature\Api\Events;

use App\Infrastructure\Eloquents\AssociateEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ome\Event\Entities\OengusMarathon;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;
use Ome\Event\Queries\InmemoryOengusMarathonQuery;
use Ome\Event\Values\MarathonStatus;
use Tests\TestCase;

class EventShowLatestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testEventShowLatest()
    {
        $now = Carbon::create(2020, 1, 5, 10, 0, 0);
        Carbon::setTestNow($now);

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

        $marathons = [
            OengusMarathon::createRegistered(
                'rtamarathon',
                'RTA Marathon',
                Carbon::create(2020, 1, 5, 9, 0, 0),
                Carbon::create(2020, 1, 6, 22, 0, 0),
                false,
                MarathonStatus::scheduled()
            ),
            OengusMarathon::createRegistered(
                'rtamarathon2',
                '2nd Marathon',
                Carbon::create(2020, 1, 9, 9, 0, 0),
                Carbon::create(2020, 1, 10, 22, 0, 0),
                false,
                MarathonStatus::scheduled()
            ),
        ];
        $oengusQuery = new InmemoryOengusMarathonQuery($marathons);

        $this->app->instance(
            OengusMarathonQuery::class,
            $oengusQuery
        );

        $response = $this->getJson(route('api.v1.events.latest'));

        $response->assertSuccessful();
        $response->assertJson([
            'id' => 'rtamarathon',
            'name' => 'RTA Marathon',
            'relateType' => 'moderate',
            'slug' => 'RM1',
            'startAt' => Carbon::create(2020, 1, 5, 9, 0, 0)->toISOString(),
            'endAt' => Carbon::create(2020, 1, 6, 22, 0, 0)->toISOString(),
            'submitsOpen' => false,
            'status' => MarathonStatus::scheduled()->value()
        ]);
    }

}
