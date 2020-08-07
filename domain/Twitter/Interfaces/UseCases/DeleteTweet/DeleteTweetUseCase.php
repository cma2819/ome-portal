<?php

namespace Ome\Twitter\Interfaces\UseCases\DeleteTweet;

/**
 * Delete Tweet.
 */
interface DeleteTweetUseCase
{
    /**
     * Delete Tweet.
     */
    public function interact(DeleteTweetRequest $request): DeleteTweetResponse;
}
