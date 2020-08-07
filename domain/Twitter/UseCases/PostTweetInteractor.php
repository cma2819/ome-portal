<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Interfaces\Commands\PersistTweetCommand;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetRequest;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetResponse;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetUseCase;

class PostTweetInteractor implements PostTweetUseCase
{
    protected PersistTweetCommand $tweetCommand;

    public function __construct(
        PersistTweetCommand $tweetCommand
    ) {
        $this->tweetCommand = $tweetCommand;
    }

    public function interact(PostTweetRequest $postTweetRequest): PostTweetResponse
    {
        $tweet = Tweet::createNewTweet(
            $postTweetRequest->getContent(),
            $postTweetRequest->getMediaIds()
        );
        return new PostTweetResponse(
            $this->tweetCommand->execute($tweet)
        );
    }
}
