<?php

namespace Tests\Mocks\Domain\Commands\Twitter;

use App\Exceptions\Twitter\TooLargeUploadedFileException;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand;

class TooLargePersistTwitterMediaCommand implements PersistTwitterMediaCommand
{
    public function execute(TwitterMedia $input): string
    {
        throw new TooLargeUploadedFileException('file is too large.');
    }
}
