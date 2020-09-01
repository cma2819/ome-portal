<?php

namespace Tests\Feature\Api\Events;

use App\Eloquents\AssociateEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\AuthAdminUser;
use Tests\TestCase;

class EventDestroyTest extends TestCase
{
    use RefreshDatabase;
    use AuthAdminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpAdminUser();
    }

    /** @test */
    public function testEventDestroy()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'moderate',
            'slug' => 'RM1'
        ]);

        $response = $this->actingAs($this->authUser(), 'api')->deleteJson(route('api.v1.events.destroy', ['event' => 'rtamarathon']));
        $response->assertNoContent();
        $this->assertDatabaseMissing('associate_events', [
            'id' => 'rtamarathon'
        ]);
    }

}
