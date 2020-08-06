<?php

namespace Tests\Unit\Domain\Twitter;

use Carbon\Carbon;
use Ome\Twitter\Commands\InmemoryDeleteTweet;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Interfaces\Commands\DeleteTweetCommand;
use Ome\Twitter\Interfaces\UseCases\DeleteTweet\DeleteTweetRequest;
use Ome\Twitter\UseCases\DeleteTweetInteractor;
use PHPUnit\Framework\TestCase;

class DeleteTweetInteractorTest extends TestCase
{
    protected InmemoryDeleteTweet $deleteTweetCommand;

    protected function setUp(): void
    {
        $this->deleteTweetCommand = new InmemoryDeleteTweet([
            PartialTweet::createPartial(
                1,
                'test 1st',
                [],
                Carbon::create(2020, 1, 1)
            ),
            PartialTweet::createPartial(
                2,
                'test 2nd',
                [1, 2, 3],
                Carbon::create(2020, 1, 2)
            ),
            PartialTweet::createPartial(
                10,
                'test 10th',
                [1, 2],
                Carbon::create(2020, 1, 10)
            )
        ]);
    }

    /** @test */
    public function testDeleteTweetSuccess()
    {
        $response = (new DeleteTweetInteractor($this->deleteTweetCommand))->interact(
            new DeleteTweetRequest(1)
        );

        $this->assertEquals(true, $response->getResult());
        $this->assertNotContains(
            PartialTweet::createPartial(
                1,
                'test 1st',
                [],
                Carbon::create(2020, 1, 1)
            ), $this->deleteTweetCommand->getTweets()
        );
    }

    /** @test */
    public function testDeleteTweetFailed()
    {
        $response = (new DeleteTweetInteractor($this->deleteTweetCommand))->interact(
            new DeleteTweetRequest(5)
        );

        $this->assertEquals(false, $response->getResult());
    }

}
