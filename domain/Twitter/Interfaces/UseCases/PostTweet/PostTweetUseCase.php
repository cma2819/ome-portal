<?php

namespace Ome\Twitter\Interfaces\UseCases\PostTweet;

interface PostTweetUseCase
{
    /**
     * Post Tweet to repository.
     *
     * @param PostTweetRequest $postTweetRequest
     * @return PostTweetResponse
     */
    public function interact(PostTweetRequest $postTweetRequest): PostTweetResponse;
}
