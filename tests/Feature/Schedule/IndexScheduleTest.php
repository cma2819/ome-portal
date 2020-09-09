<?php

namespace Tests\Feature\Schedule;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testIndexSchedule()
    {
        $response = $this->get(route('schedules.index'));

        $response->assertSuccessful();
        $response->assertViewIs('schedule.detail');
    }

}
