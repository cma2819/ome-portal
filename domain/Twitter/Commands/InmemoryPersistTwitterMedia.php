<?php

namespace Ome\Twitter\Commands;

use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMedia\PersistTwitterMediaCommand;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMedia\PersistTwitterMediaInput;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMedia\PersistTwitterMediaFeedback;

class InmemoryPersistTwitterMedia implements PersistTwitterMediaCommand
{
    /** @var TwitterMedia[] */
    private array $twitterMedias = [];

    public function execute(PersistTwitterMediaInput $input): PersistTwitterMediaFeedback
    {
        $nextId = $this->nextId();
        $this->twitterMedia[$nextId] = $input->getTwitterMedia();

        return new PersistTwitterMediaFeedback(
            PartialTwitterMedia::createPartial(
                $nextId,
                $input->getTwitterMedia()->getMediaUrl(),
                $input->getTwitterMedia()->getType(),
            )
        );
    }

    public function nextId(): int
    {
        return (array_key_last($this->twitterMedias) ?? 0) + 1;
    }
}
