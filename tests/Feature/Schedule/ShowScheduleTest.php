<?php

namespace Tests\Feature\Schedule;

use App\Infrastructure\Eloquents\AssociateEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testShowSchedule()
    {
        AssociateEvent::create([
            'id' => 'rtamarathon',
            'relate_type' => 'support',
            'slug' => 'RM1',
        ]);

        $response = $this->get(route('schedules.show', [
            'id' => 'rtamarathon'
        ]));

        $response->assertSuccessful();
        $response->assertViewIs('schedule.detail');
    }

    /** @test */
    public function testShowScheduleNotFound()
    {
        $response = $this->get(route('schedules.show', [
            'id' => 'rtamarathon'
        ]));

        $response->assertNotFound();
    }

}
