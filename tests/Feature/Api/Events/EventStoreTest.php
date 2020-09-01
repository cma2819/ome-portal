<?php

namespace Tests\Feature\Api\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class EventStoreTest extends TestCase
{
    use RefreshDatabase;
    use AuthAdminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testEventStore()
    {
        $response = $this->actingAs($this->authUser(), 'api')->postJson(route('api.v1.events.store'), [
            'id' => 'rta1kagawa',
            'relateType' => 'moderate',
            'slug' => 'R1KONLINE'
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('associate_events', [
            'id' => 'rta1kagawa',
            'relate_type' => 'moderate',
            'slug' => 'R1KONLINE'
        ]);
    }

}
