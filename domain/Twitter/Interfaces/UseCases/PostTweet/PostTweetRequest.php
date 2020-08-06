<?php

namespace Ome\Twitter\Interfaces\UseCases\PostTweet;

class PostTweetRequest
{
    private string $content;

    /** @var int[] */
    private array $mediaIds;

    public function __construct(
        string $content,
        array $mediaIds
    )
    {
        $this->content = $content;
        $this->mediaIds = $mediaIds;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of mediaIds
     */
    public function getMediaIds()
    {
        return $this->mediaIds;
    }
}
