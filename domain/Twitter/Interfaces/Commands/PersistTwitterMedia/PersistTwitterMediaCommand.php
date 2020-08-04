<?php

namespace Ome\Twitter\Interfaces\Commands\PersistTwitterMedia;

interface PersistTwitterMediaCommand
{
    public function execute(PersistTwitterMediaInput $input): PersistTwitterMediaFeedback;
}
