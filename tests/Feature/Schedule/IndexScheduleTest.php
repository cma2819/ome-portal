<?php

namespace Tests\Feature\Schedule;

use App\Infrastructure\Eloquents\AssociateEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testIndexSchedule()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'support',
            'slug' => 'RM1',
        ]);
        $response = $this->get(route('events.schedules.index', ['id' => 'rtamarathon']));

        $response->assertSuccessful();
        $response->assertViewIs('event.index');
    }

    /** @test */
    public function testIndexNotFound()
    {
        $response = $this->get(route('events.schedules.index', ['id' => 'RM1']));

        $response->assertNotFound();
    }
}
