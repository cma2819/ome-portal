<?php

namespace Tests\Feature\Event;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexEventTest extends TestCase
{
    /** @test */
    public function testIndexSuccess()
    {
        $response = $this->get(route('events.index'));

        $response->assertSuccessful();
    }

}
