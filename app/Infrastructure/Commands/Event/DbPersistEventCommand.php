<?php

namespace App\Infrastructure\Commands\Event;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Facades\Logger;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Commands\PersistEventCommand;

class DbPersistEventCommand implements PersistEventCommand
{
    public function execute(Event $event): Event
    {
        Logger::debug('string', 'Event.Command', 'PersistEvent called with:');
        Logger::debug('json', 'Event.Command', json_encode([
            'id' => $event->getId(),
            'relateType' => $event->getRelateType()->value(),
            'slug' => $event->getSlug()->value(),
        ]));

        $eventEloquent = AssociateEvent::find($event->getId());

        if (is_null($eventEloquent)) {
            $eventEloquent = new AssociateEvent(['id' => $event->getId()]);
        }

        $eventEloquent->relate_type = $event->getRelateType()->value();
        $eventEloquent->slug = $event->getSlug()->value();
        $eventEloquent->save();
        Logger::debug('string', 'Event.Command', 'Persist event: ');
        Logger::debug('json', 'Event.Command', 'Persist event: ' . $eventEloquent->toJson());

        return $event;
    }
}
