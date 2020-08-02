<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\UseCases\GetTimelineUseCase;

class GetTimelineInteractor implements GetTimelineUseCase{
    protected TweetRepository $tweetRepository;

    public function __construct(
        TweetRepository $tweetRepository
    )
    {
        $this->tweetRepository = $tweetRepository;
    }

    /**
     * Get user's timeline.
     *
     * @return Tweet[]
     */
    public function interact(): array
    {
        return $this->tweetRepository->listTweet();
    }
}
