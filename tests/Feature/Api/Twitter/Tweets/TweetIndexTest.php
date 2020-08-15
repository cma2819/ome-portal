<?php

namespace Tests\Feature\Api\Twitter\Tweets;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Values\TwitterMediaType;
use Tests\TestCase;

class TweetIndexTest extends TestCase
{
    use RefreshDatabase;
    use AuthTwitterUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpTwitterUser();

        // Tweets
        $this->app->bind('InmemoryTweetStore', function ($app) {
            return [
                PartialTweet::createPartial(
                    '1',
                    'first tweet',
                    [],
                    Carbon::create(2020, 1, 1)
                ),
                PartialTweet::createPartial(
                    '2',
                    'second tweet',
                    ['10001'],
                    Carbon::create(2020, 1, 2)
                ),
                PartialTweet::createPartial(
                    '10',
                    'tenth tweet',
                    ['10002'],
                    Carbon::create(2020, 1, 10)
                ),
            ];
        });

        // TwitterMedias
        $this->app->bind('InmemoryTwitterMediaStore', function ($app) {
            return [
                PartialTwitterMedia::createPartial(
                    '10001',
                    'https://example.com/10001',
                    TwitterMediaType::photo()
                ),
                PartialTwitterMedia::createPartial(
                    '10002',
                    'https://example.com/10002',
                    TwitterMediaType::video()
                ),
            ];
        });
    }

    /** @test */
    public function testRequestSuccess()
    {
        $response = $this->actingAs($this->twitterUser(), 'api')->getJson(route('api.v1.twitter.tweets.index'));

        $response->assertSuccessful();
        $response->assertJson([
            [
                'id' => '1',
                'text' => 'first tweet',
                'medias' => [],
                'createdAt' => Carbon::create(2020, 1, 1)->toISOString()
            ],
            [
                'id' => '2',
                'text' => 'second tweet',
                'medias' => [
                    [
                        'id' => '10001',
                        'mediaUrl' => 'https://example.com/10001',
                        'type' => 'photo',
                    ]
                ],
                'createdAt' => Carbon::create(2020, 1, 2)->toISOString()
            ],
            [
                'id' => '10',
                'text' => 'tenth tweet',
                'medias' => [
                    [
                        'id' => '10002',
                        'mediaUrl' => 'https://example.com/10002',
                        'type' => 'video',
                    ]
                ],
                'createdAt' => Carbon::create(2020, 1, 10)->toISOString()
            ],
        ]);
    }
}
