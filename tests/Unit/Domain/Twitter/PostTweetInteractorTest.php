<?php

namespace Tests\Unit\Domain\Twitter;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Ome\Twitter\Commands\InmemoryPersistTweet;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Entities\PartialTwitterUser;
use Ome\Twitter\Entities\TwitterUser;
use Ome\Twitter\Interfaces\Commands\PersistTweet\PersistTweetCommand;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetRequest;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetResponse;
use Ome\Twitter\Repositories\InmemoryTweetRepository;
use Ome\Twitter\Repositories\InmemoryTwitterMediaRepository;
use Ome\Twitter\UseCases\PostTweetInteractor;
use Ome\Twitter\Values\TwitterMediaType;
use PHPUnit\Framework\TestCase;

class PostTweetInteractorTest extends TestCase
{
    protected TwitterUser $user;

    protected TwitterMediaRepository $mediaRepository;

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
            PartialTweet::createPartial(
                1,
                'test tweet',
                [],
                $now
            ),
            $response->getTweet()
        );

        $this->assertEquals([
            1 => $response->getTweet()
        ], $persistTweetCommand->getTweets());
    }

    /** @test */
    public function testPostTweetWithMedia()
    {
        $now = Carbon::now();
        Carbon::setTestNow($now);

        $persistTweetCommand = new InmemoryPersistTweet;

        $response = (new PostTweetInteractor($persistTweetCommand))->interact(
            new PostTweetRequest('test tweet', [1, 2, 3, 4])
        );

        $this->assertEquals(
            PartialTweet::createPartial(
                1,
                'test tweet',
                [1, 2, 3, 4],
                $now
            ),
            $response->getTweet()
        );

        $this->assertEquals([
            1 => $response->getTweet()
        ], $persistTweetCommand->getTweets());
    }
}
