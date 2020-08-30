<?php

namespace Ome\Event\Interfaces\Commands;

use Ome\Event\Entities\Event;

interface PersistEventCommand
{
    public function execute(Event $event): Event;
}
