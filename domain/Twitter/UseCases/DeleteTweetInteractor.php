<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Interfaces\Commands\DeleteTweetCommand;
use Ome\Twitter\Interfaces\UseCases\DeleteTweet\DeleteTweetResponse;
use Ome\Twitter\Interfaces\UseCases\DeleteTweet\DeleteTweetRequest;
use Ome\Twitter\Interfaces\UseCases\DeleteTweet\DeleteTweetUseCase;

class DeleteTweetInteractor implements DeleteTweetUseCase
{
    protected DeleteTweetCommand $deleteTweetCommand;

    public function __construct(
        DeleteTweetCommand $deleteTweetCommand
    ) {
        $this->deleteTweetCommand = $deleteTweetCommand;
    }

    public function interact(DeleteTweetRequest $request): DeleteTweetResponse
    {
        return new DeleteTweetResponse($this->deleteTweetCommand->execute($request->getId()));
    }
}
