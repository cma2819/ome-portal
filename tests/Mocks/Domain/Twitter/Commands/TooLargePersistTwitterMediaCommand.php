<?php

namespace Tests\Mocks\Domain\Twitter\Commands;

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
