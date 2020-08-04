<?php

namespace Ome\Twitter\Interfaces\Commands\PersistTweet;

interface PersistTweetCommand
{
    public function execute(PersistTweetInput $input): PersistTweetFeedback;
}
