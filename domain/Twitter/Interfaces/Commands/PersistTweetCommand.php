<?php

namespace Ome\Twitter\Interfaces\Commands;

use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Interfaces\Dto\TweetDto;

interface PersistTweetCommand
{
    public function execute(Tweet $input): TweetDto;
}
