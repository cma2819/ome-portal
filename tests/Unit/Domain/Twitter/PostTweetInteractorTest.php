<?php

namespace Tests\Unit\Domain\Twitter;

use Carbon\Carbon;
use Ome\Twitter\Commands\InmemoryPersistTweet;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Entities\TwitterUser;
use Ome\Twitter\Interfaces\Dto\TweetDto;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetRequest;
use Ome\Twitter\UseCases\PostTweetInteractor;
use Ome\Twitter\Values\TwitterMediaType;
use PHPUnit\Framework\TestCase;

class PostTweetInteractorTest extends TestCase
{

    protected function setUp(): void
    {
        $this->persistTweetCommand = new InmemoryPersistTweet;
    }

    /** @test */
    public function testPostTweet()
    {
        $now = Carbon::now();
        Carbon::setTestNow($now);

        $persistTweetCommand = new InmemoryPersistTweet;

        $response = (new PostTweetInteractor($persistTweetCommand))->interact(
            new PostTweetRequest('test tweet', [])
        );

        $this->assertEquals(
            new TweetDto(
                PartialTweet::createPartial(
                    '1',
                    'test tweet',
                    [],
                    $now
                ),
                []
            ),
            $response->getTweet()
        );

        $this->assertEquals([
            1 => PartialTweet::createPartial(
                '1',
                'test tweet',
                [],
                $now
            )
        ], $persistTweetCommand->getTweets());
    }

    /** @test */
    public function testPostTweetWithMedia()
    {
        $now = Carbon::now();
        Carbon::setTestNow($now);

        $initialMedias = [
            1 => PartialTwitterMedia::createPartial(
                '1', 'test1.png', TwitterMediaType::photo()
            ),
            2 => PartialTwitterMedia::createPartial(
                '2', 'test1.png', TwitterMediaType::photo()
            ),
            3 => PartialTwitterMedia::createPartial(
                '3', 'test1.png', TwitterMediaType::photo()
            ),
            4 => PartialTwitterMedia::createPartial(
                '4', 'test1.png', TwitterMediaType::photo()
            ),
        ];
        $persistTweetCommand = new InmemoryPersistTweet($initialMedias);

        $response = (new PostTweetInteractor($persistTweetCommand))->interact(
            new PostTweetRequest('test tweet', ['1', '2', '3', '4'])
        );

        $this->assertEquals(
            new TweetDto(
                PartialTweet::createPartial(
                    '1',
                    'test tweet',
                    ['1', '2', '3', '4'],
                    $now
                ),
                [
                    PartialTwitterMedia::createPartial(
                        '1', 'test1.png', TwitterMediaType::photo()
                    ),
                    PartialTwitterMedia::createPartial(
                        '2', 'test1.png', TwitterMediaType::photo()
                    ),
                    PartialTwitterMedia::createPartial(
                        '3', 'test1.png', TwitterMediaType::photo()
                    ),
                    PartialTwitterMedia::createPartial(
                        '4', 'test1.png', TwitterMediaType::photo()
                    ),
                ]
            ),
            $response->getTweet()
        );

        $this->assertEquals([
            1 => PartialTweet::createPartial(
                '1',
                'test tweet',
                ['1', '2', '3', '4'],
                $now
            )
        ], $persistTweetCommand->getTweets());
    }
}
