<?php

namespace Tests\Unit\Domain\Twitter;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Entities\PartialTwitterUser;
use Ome\Twitter\Entities\TwitterUser;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Repositories\InmemoryTweetRepository;
use Ome\Twitter\Repositories\InmemoryTwitterMediaRepository;
use Ome\Twitter\UseCases\PostTweetInteractor;
use Ome\Twitter\Values\TwitterMediaType;
use PHPUnit\Framework\TestCase;

class PostTweetInteractorTest extends TestCase
{
    protected TwitterUser $user;

    protected TweetRepository $tweetRepository;

    protected TwitterMediaRepository $mediaRepository;

    protected function setUp(): void
    {
        $this->user = PartialTwitterUser::createPartial(1000, 'Test User', 'test_user');
        $medias = [
            1 => PartialTwitterMedia::createPartial(
                1,
                'media 1',
                TwitterMediaType::photo()
            ),
            2 => PartialTwitterMedia::createPartial(
                2,
                'media 2',
                TwitterMediaType::photo()
            ),
            3 => PartialTwitterMedia::createPartial(
                3,
                'media 3',
                TwitterMediaType::photo()
            ),
            4 => PartialTwitterMedia::createPartial(
                4,
                'media 4',
                TwitterMediaType::photo()
            ),
        ];
        $this->mediaRepository = new InmemoryTwitterMediaRepository($medias);

        $this->tweetRepository = new InmemoryTweetRepository(
            $this->user,
            [],
            $this->mediaRepository
        );
    }

    /** @test */
    public function testPostTweet()
    {
        $now = Carbon::now();
        Carbon::setTestNow($now);

        $tweet = (new PostTweetInteractor($this->tweetRepository))->interact('test tweet', []);

        $this->assertEquals(PartialTweet::createPartial(
            1,
            'test tweet',
            $this->user,
            [],
            $now
        ), $tweet);

        $this->assertEquals([
            1 => $tweet
        ], $this->tweetRepository->listTweet());
    }

    /** @test */
    public function testPostTweetWithMedia()
    {
        $now = Carbon::now();
        Carbon::setTestNow($now);

        $tweet = (new PostTweetInteractor($this->tweetRepository))->interact('test tweet', [1, 2, 3, 4]);
        $medias = [
            PartialTwitterMedia::createPartial(
                1,
                'media 1',
                TwitterMediaType::photo()
            ),
            PartialTwitterMedia::createPartial(
                2,
                'media 2',
                TwitterMediaType::photo()
            ),
            PartialTwitterMedia::createPartial(
                3,
                'media 3',
                TwitterMediaType::photo()
            ),
            PartialTwitterMedia::createPartial(
                4,
                'media 4',
                TwitterMediaType::photo()
            ),
        ];

        $this->assertEquals(PartialTweet::createPartial(
            1,
            'test tweet',
            $this->user,
            $medias,
            $now
        ), $tweet);

        $this->assertEquals([
            1 => $tweet
        ], $this->tweetRepository->listTweet());
    }

}
