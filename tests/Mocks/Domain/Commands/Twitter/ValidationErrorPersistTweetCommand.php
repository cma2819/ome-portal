<?php

namespace Tests\Mocks\Domain\Commands\Twitter;

use App\Exceptions\Twitter\TwitterValidationException;
use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Interfaces\Commands\PersistTweetCommand;
use Ome\Twitter\Interfaces\Dto\TweetDto;

class ValidationErrorPersistTweetCommand implements PersistTweetCommand
{
    public function execute(Tweet $input): TweetDto
    {
        throw new TwitterValidationException('input error');
    }
}
