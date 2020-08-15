<?php

namespace Tests\Feature\Api\Twitter\Tweets;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MediaStoreTest extends TestCase
{
    use RefreshDatabase;
    use AuthTwitterUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpTwitterUser();
    }

    /** @test */
    public function testStoreTwitterMedia()
    {
        $file = UploadedFile::fake()->image('test.jpg')->mimeType('image/jpg');

        $response = $this->actingAs($this->twitterUser(), 'api')->postJson(route('api.v1.twitter.medias.store'), ['media' => $file]);
        $response->assertSuccessful();
        $response->assertJson(['id' => '1']);
    }

    /** @test */
    public function testFailedWithTooLargeMedia()
    {
        $this->app->bind(
            \Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand::class,
            \Tests\Mocks\Domain\Twitter\Commands\TooLargePersistTwitterMediaCommand::class
        );

        $file = UploadedFile::fake()->image('test.jpg')->mimeType('image/jpg');

        $response = $this->actingAs($this->twitterUser(), 'api')->postJson(route('api.v1.twitter.medias.store'), ['media' => $file]);
        $response->assertStatus(413);
    }
}
