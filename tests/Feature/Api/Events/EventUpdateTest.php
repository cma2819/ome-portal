<?php

namespace Tests\Feature\Api\Events;

use App\Eloquents\AssociateEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class EventUpdateTest extends TestCase
{
    use RefreshDatabase;
    use AuthAdminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testEventUpdate()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);

        $response = $this->actingAs($this->authUser(), 'api')->putJson(route('api.v1.events.update', ['event' => 'rtamarathon']), [
            'relateType' => 'support',
            'slug' => 'RTAM'
        ]);

        $response->assertNoContent();
    }

    /** @test */
    public function testEventUpdateNotFound()
    {
        $response = $this->actingAs($this->authUser(), 'api')->putJson(route('api.v1.events.update', ['event' => 'rtamarathon']), [
            'relateType' => 'support',
            'slug' => 'RTAM'
        ]);

        $response->assertNotFound();
    }


}
