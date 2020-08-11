<?php

namespace Ome\Twitter\Interfaces\Commands;

use Ome\Twitter\Entities\TwitterMedia;

interface PersistTwitterMediaCommand
{
    /**
     * Persist Twitter's media.
     *
     * @param TwitterMedia $input
     * @return string Uploaded media ID.
     */
    public function execute(TwitterMedia $input): string;
}
