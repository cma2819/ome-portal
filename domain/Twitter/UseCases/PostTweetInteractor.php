<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\UseCases\PostTweetUseCase;

class PostTweetInteractor implements PostTweetUseCase
{

    protected TweetRepository $tweetRepository;

    public function __construct(
        TweetRepository $tweetRepository
    )
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function interact(string $content, array $mediaIds): Tweet
    {
        return $this->tweetRepository->save($content, $mediaIds);
    }
}
