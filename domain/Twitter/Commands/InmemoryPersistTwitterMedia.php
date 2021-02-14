<?php

namespace Ome\Twitter\Commands;

use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand;

class InmemoryPersistTwitterMedia implements PersistTwitterMediaCommand
{
    /** @var TwitterMedia[] */
    private array $twitterMedias = [];

    public function __construct(
        array $twitterMedias = []
    ) {
        $this->twitterMedias = $twitterMedias;
    }

    public function execute(TwitterMedia $input): string
    {
        $nextId = $this->nextId();
        $this->twitterMedia[$nextId] = $input;

        return $nextId;
    }

    public function nextId(): int
    {
        return (array_key_last($this->twitterMedias) ?? 0) + 1;
    }
}
