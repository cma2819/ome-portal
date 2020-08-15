<?php

namespace Tests\Feature\Api\Twitter\Tweets;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Values\TwitterMediaType;
use Tests\TestCase;

class TweetStoreTest extends TestCase
{
    use RefreshDatabase;
    use AuthTwitterUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpTwitterUser();

        $this->app->bind('InmemoryTwitterMediaStore', function ($app) {
            return [
                PartialTwitterMedia::createPartial(
                    '1',
                    'https://example.com/media/1',
                    TwitterMediaType::photo()
                ),
                PartialTwitterMedia::createPartial(
                    '2',
                    'https://example.com/media/2',
                    TwitterMediaType::photo()
                )
            ];
        });
    }

    /** @test */
    public function testTweetNoMediaSuccess()
    {
        $now = Carbon::create(2020, 1, 1, 12, 34);
        Carbon::setTestNow($now);

        $postData = [
            'text' => 'This is test tweet!',
            'mediaIds' => []
        ];
        $response = $this->actingAs($this->twitterUser(), 'api')->postJson(route('api.v1.twitter.tweets.store'), $postData);

        $response->assertSuccessful();
        $response->assertJson([
            'id' => '1',
            'text' => 'This is test tweet!',
            'medias' => [],
            'createdAt' => $now->toISOString()
        ]);
    }

    /** @test */
    public function testTweetWithMediaSuccess()
    {
        $now = Carbon::create(2020, 1, 1, 12, 34);
        Carbon::setTestNow($now);

        $postData = [
            'text' => 'This is test tweet!',
            'mediaIds' => ['1', '2']
        ];
        $response = $this->actingAs($this->twitterUser(), 'api')->postJson(route('api.v1.twitter.tweets.store'), $postData);

        $response->assertSuccessful();
        $response->assertJson([
            'id' => '1',
            'text' => 'This is test tweet!',
            'medias' => [
                [
                    'id' => '1',
                    'mediaUrl' => 'https://example.com/media/1',
                    'type' => 'photo'
                ],
                [
                    'id' => '2',
                    'mediaUrl' => 'https://example.com/media/2',
                    'type' => 'photo'
                ]
            ],
            'createdAt' => $now->toISOString()
        ]);
    }

    /** @test */
    public function testHttpErrorFromTwitter()
    {
        $this->app->bind(
            \Ome\Twitter\Interfaces\Commands\PersistTweetCommand::class,
            \Tests\Mocks\Domain\Twitter\Commands\ValidationErrorPersistTweetCommand::class
        );

        $postData = [
            'text' => 'This is test tweet!',
            'mediaIds' => ['1', '2']
        ];
        $response = $this->actingAs($this->twitterUser(), 'api')->postJson(route('api.v1.twitter.tweets.store'), $postData);
        $response->assertStatus(422);
    }

    /** @test */
    public function testFailedWithNoText()
    {
        $postData = [
            'text' => '',
            'mediaIds' => []
        ];
        $response = $this->actingAs($this->twitterUser(), 'api')->postJson(route('api.v1.twitter.tweets.store'), $postData);
        $response->assertStatus(422);
    }
}
