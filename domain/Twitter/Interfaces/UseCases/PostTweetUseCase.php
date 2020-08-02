<?php

namespace Ome\Twitter\Interfaces\UseCases;

use Ome\Twitter\Entities\Tweet;

interface PostTweetUseCase {
    /**
     * Post Tweet to repository.
     *
     * @param string $content
     * @param int[] $mediaIds
     * @return Tweet
     */
    public function interact(string $content, array $mediaIds): Tweet;
}
