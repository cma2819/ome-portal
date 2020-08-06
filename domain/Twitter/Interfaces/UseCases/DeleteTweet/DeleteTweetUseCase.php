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
	function interact(DeleteTweetRequest $request): DeleteTweetResponse;
}
