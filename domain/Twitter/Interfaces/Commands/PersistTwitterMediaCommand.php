<?php

namespace Ome\Twitter\Interfaces\Commands;

use Ome\Twitter\Entities\TwitterMedia;

interface PersistTwitterMediaCommand
{
    public function execute(TwitterMedia $input): TwitterMedia;
}
