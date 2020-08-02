<?php

namespace Ome\Twitter\Interfaces\Repositories;

use Ome\Twitter\Entities\Tweet;

interface TweetRepository
{
    /**
     * List tweet from repository.
     *
     * @return array
     */
    public function listTweet(): array;

    /**
     * Save new tweet has received content.
     *
     * @param string $content
     * @param int[] $mediaIds
     * @return Tweet
     */
    public function save(string $content, array $mediaIds): Tweet;
}
