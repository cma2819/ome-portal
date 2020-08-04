<?php

namespace Ome\Twitter\Commands;

use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand;

class InmemoryPersistTwitterMedia implements PersistTwitterMediaCommand
{
    /** @var TwitterMedia[] */
    private array $twitterMedias = [];

    public function execute(TwitterMedia $input): TwitterMedia
    {
        $nextId = $this->nextId();
        $this->twitterMedia[$nextId] = $input;

        return PartialTwitterMedia::createPartial(
            $nextId,
            $input->getMediaUrl(),
            $input->getType(),
        );
    }

    public function nextId(): int
    {
        return (array_key_last($this->twitterMedias) ?? 0) + 1;
    }
}
