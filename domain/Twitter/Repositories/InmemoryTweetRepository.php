<?php

namespace Ome\Twitter\Repositories;

use Carbon\Carbon;
use Ome\Twitter\Entities\PartialTweet;
use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Entities\TwitterUser;
use Ome\Twitter\Interfaces\Repositories\TweetRepository;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;

class InmemoryTweetRepository implements TweetRepository
{

    protected TwitterUser $user;

    protected TwitterMediaRepository $mediaRepository;

    /**
     * @var Tweet[]
     */
    public array $tweets;

    /**
     * @param TwitterUser $user
     * @param array $tweets
     */
    public function __construct(
        TwitterUser $user,
        array $tweets,
        TwitterMediaRepository $mediaRepository
    )
    {
        $this->user = $user;
        $this->tweets = $tweets;
        $this->mediaRepository = $mediaRepository;
    }

    public function listTweet(): array
    {
        return $this->tweets;
    }

    public function save(string $content, array $mediaIds): Tweet
    {
        $medias = [];
        foreach ($mediaIds as $mediaId) {
            $medias[] = $this->mediaRepository->find($mediaId);
        }
        $tweet = PartialTweet::createPartial(
            $this->nextId(),
            $content,
            $this->user,
            $medias,
            Carbon::now()
        );
        $this->tweets[$tweet->getId()] = $tweet;
        return $tweet;
    }

    public function nextId(): int
    {
        return (array_key_last($this->tweets) ?? 0) + 1;
    }
}
