<?php

namespace Tests\Feature\Api\Twitter\Tweets;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TweetIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function testRequestSuccess()
    {
        $response = $this->get(route('api.v1.twitter.tweets.index'));
        $response->assertSuccessful();
    }

}
