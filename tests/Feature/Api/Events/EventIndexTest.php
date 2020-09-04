<?php

namespace Tests\Feature\Api\Events;

use App\Eloquents\AssociateEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
                'relateType' => 'moderate',
                'slug' => 'RM1'
            ],
            [
                'id' => 'rtamarathon2',
                'relateType' => 'support',
                'slug' => 'RM2'
            ]
        ]);
    }

}
