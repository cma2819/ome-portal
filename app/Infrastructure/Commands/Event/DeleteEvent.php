<?php

namespace App\Infrastructure\Commands\Event;

use App\Infrastructure\Eloquents\AssociateEvent;
use Ome\Event\Interfaces\Commands\DeleteEventCommand;

class DeleteEvent implements DeleteEventCommand
{
    public function execute(string $id): bool
    {
        $eventEloquent = AssociateEvent::find($id);

        if (is_null($eventEloquent)) {
            return false;
        }

        $eventEloquent->delete();

        return true;
    }
}
