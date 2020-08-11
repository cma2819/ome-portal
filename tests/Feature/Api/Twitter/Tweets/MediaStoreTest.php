<?php

namespace Tests\Feature\Api\Twitter\Tweets;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MediaStoreTest extends TestCase
{
    /** @test */
    public function testStoreTwitterMedia()
    {
        $file = UploadedFile::fake()->image('test.jpg')->mimeType('image/jpg');

        $response = $this->postJson(route('api.v1.twitter.medias.store'), ['media' => $file]);
        $response->assertSuccessful();
        $response->assertJson(['id' => '1']);
    }

    /** @test */
    public function testFailedWithTooLargeMedia()
    {
        $this->app->bind(
            \Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand::class,
            \Tests\Mocks\Domain\Commands\Twitter\TooLargePersistTwitterMediaCommand::class
        );

        $file = UploadedFile::fake()->image('test.jpg')->mimeType('image/jpg');

        $response = $this->postJson(route('api.v1.twitter.medias.store'), ['media' => $file]);
        $response->assertStatus(413);
    }
}
