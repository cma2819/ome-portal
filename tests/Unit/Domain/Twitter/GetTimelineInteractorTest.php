<?php

namespace Tests\Unit\Domain\Twitter;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Interfaces\Dto\TweetDto;
use Ome\Twitter\Interfaces\Queries\TimelineQuery;
use Ome\Twitter\Interfaces\UseCases\GetTimeline\GetTimelineResponse;
use Ome\Twitter\Queries\InmemoryTimelineQuery;
use Ome\Twitter\UseCases\GetTimelineInteractor;
use PHPUnit\Framework\TestCase;

class GetTimelineInteractorTest extends TestCase
{
    protected function setUp(): void
    {
        $now = CarbonImmutable::create(2020, 1, 1);
        $initialTweets = [
                PartialTweet::createPartial(
                    1,
                    'test tweet 1st',
                    [],
                    $now
                ),
                PartialTweet::createPartial(
                    2,
                    'test tweet 2nd',
                    [],
                    $now->addDay(1)
                ),
                PartialTweet::createPartial(
                    3,
                    'test tweet 3rd',
                    [],
                    $now->addMonth(1)
                )
        ];
        $this->timelineQuery = new InmemoryTimelineQuery(
            $initialTweets
        );
    }

    /** @test */
    public function testGetTimeline()
    {
        $timeline = (new GetTimelineInteractor($this->timelineQuery))->interact();
        $this->assertEquals(new GetTimelineResponse([
            new TweetDto(
                PartialTweet::createPartial(
                    1,
                    'test tweet 1st',
                    [],
                    Carbon::create(2020, 1, 1)
                ),
                []
            ),
            new TweetDto(
                PartialTweet::createPartial(
                    2,
                    'test tweet 2nd',
                    [],
                    Carbon::create(2020, 1, 2)
                ),
                []
            ),
            new TweetDto(
                PartialTweet::createPartial(
                    3,
                    'test tweet 3rd',
                    [],
                    Carbon::create(2020, 2, 1)
                ),
                []
            )
        ]), $timeline);
    }
}
