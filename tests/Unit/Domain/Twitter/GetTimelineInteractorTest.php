<?php

namespace Tests\Unit\Domain\Twitter;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\PartialTwitterUser;
use Ome\Twitter\Entities\TwitterUser;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Repositories\InmemoryTweetRepository;
use Ome\Twitter\Repositories\InmemoryTwitterMediaRepository;
use Ome\Twitter\UseCases\GetTimelineInteractor;
use PHPUnit\Framework\TestCase;

class GetTimelineInteractorTest extends TestCase
{
    protected TwitterUser $user;

    protected TweetRepository $tweetRepository;

    protected TwitterMediaRepository $mediaRepository;

    protected function setUp(): void
    {
        $now = CarbonImmutable::create(2020, 1, 1);
        $this->user = PartialTwitterUser::createPartial(1000, 'Test User', 'test_user');
        $this->mediaRepository = new InmemoryTwitterMediaRepository();
        $initialTweets = [
            PartialTweet::createPartial(
                1,
                'test tweet 1st',
                $this->user,
                [],
                $now
            ),
            PartialTweet::createPartial(
                2,
                'test tweet 2nd',
                $this->user,
                [],
                $now->addDay(1)
            ),
            PartialTweet::createPartial(
                3,
                'test tweet 3rd',
                $this->user,
                [],
                $now->addMonth(1)
            )
        ];
        $this->tweetRepository = new InmemoryTweetRepository(
            $this->user,
            $initialTweets,
            $this->mediaRepository
        );
    }

    /** @test */
    public function testGetTimeline()
    {
        $timeline = (new GetTimelineInteractor($this->tweetRepository))->interact();
        $this->assertEquals([
            PartialTweet::createPartial(
                1,
                'test tweet 1st',
                $this->user,
                [],
                Carbon::create(2020, 1, 1)
            ),
            PartialTweet::createPartial(
                2,
                'test tweet 2nd',
                $this->user,
                [],
                Carbon::create(2020, 1, 2)
            ),
            PartialTweet::createPartial(
                3,
                'test tweet 3rd',
                $this->user,
                [],
                Carbon::create(2020, 2, 1)
            )
            ], $timeline);
    }

}
