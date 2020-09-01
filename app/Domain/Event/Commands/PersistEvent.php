<?php

namespace App\Domain\Event\Commands;

use App\Eloquents\AssociateEvent;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Commands\PersistEventCommand;

class PersistEvent implements PersistEventCommand
{
    public function execute(Event $event): Event
    {
        $eventEloquent = AssociateEvent::find($event->getId());

        if (is_null($eventEloquent)) {
            $eventEloquent = new AssociateEvent(['id' => $event->getId()]);
        }
        $eventEloquent->relate_type = $event->getRelateType()->value();
        $eventEloquent->slug = $event->getSlug()->value();
        $eventEloquent->save();

        return $event;
    }
}
