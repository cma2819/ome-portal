<?php

namespace Ome\Event\Interfaces\Commands;

use Ome\Event\Entities\EventScheme;

interface PersistEventSchemeCommand
{
    public function execute(EventScheme $eventScheme): EventScheme;
}
