<?php

namespace Ome\Event\Interfaces\Commands;

use Ome\Event\Entities\EventPlan;

interface PersistEventPlanCommand
{
    public function execute(EventPlan $eventPlan): EventPlan;
}
