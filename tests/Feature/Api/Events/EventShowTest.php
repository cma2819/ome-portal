<?php

namespace Tests\Feature\Api\Events;

use App\Eloquents\AssociateEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\AuthAdminUser;
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
            'slug' => 'R1KONLINE'
        ]);
        $response = $this->getJson(route('api.v1.events.show', ['event' => 'rtamarathon']));

        $response->assertSuccessful();
        $response->assertJson([
            'id' => 'rtamarathon',
            'relateType' => 'moderate',
            'slug' => 'R1KONLINE'
        ]);
    }

    /** @test */
    public function testEventNotFound()
    {
        $response = $this->getJson(route('api.v1.events.show', ['event' => 'rtamarathon']));

        $response->assertNotFound();
    }


}
