<?php

namespace Ome\Twitter\Interfaces\Commands\PersistTwitterMedia;

use Ome\Twitter\Entities\TwitterMedia;

class PersistTwitterMediaInput
{
    private TwitterMedia $twitterMedia;

    public function __construct(TwitterMedia $twitterMedia)
    {
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
