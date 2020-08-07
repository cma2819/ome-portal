<?php

namespace Ome\Twitter\Interfaces\UseCases\UploadMedia;

use Ome\Twitter\Entities\TwitterMedia;

class UploadMediaResponse
{
    private TwitterMedia $twitterMedia;

    public function __construct(
        TwitterMedia $twitterMedia
    ) {
        $this->twitterMedia = $twitterMedia;
    }

    /**
     * Get the value of twitterMedia
     */
    public function getTwitterMedia()
    {
        return $this->twitterMedia;
    }
}
