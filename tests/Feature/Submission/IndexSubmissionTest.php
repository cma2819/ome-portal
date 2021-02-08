<?php

namespace Tests\Feature\Submission;

use App\Infrastructure\Eloquents\AssociateEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexSubmissionTest extends TestCase
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
        $response = $this->get(route('events.submissions.index', ['id' => 'rtamarathon']));

        $response->assertSuccessful();
        $response->assertViewIs('event.index');
    }

    /** @test */
    public function testIndexNotFound()
    {
        $response = $this->get(route('events.submissions.index', ['id' => 'rtamarathon']));

        $response->assertNotFound();
    }

}
