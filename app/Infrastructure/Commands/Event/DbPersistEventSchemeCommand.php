<?php

namespace App\Infrastructure\Commands\Event;

use App\Facades\Logger;
use App\Infrastructure\Eloquents\EventScheme as EventSchemeEloquent;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Commands\PersistEventSchemeCommand;

class DbPersistEventSchemeCommand implements PersistEventSchemeCommand
{
    public function execute(EventScheme $eventScheme): EventScheme
    {
        Logger::debug('string', 'Event.Command', 'PersistEventScheme called with:');
        Logger::debug('json', 'Event.Command', json_encode([
            'id' => $eventScheme->getId(),
            'status' => $eventScheme->getStatus()->value(),
            'startAt' => $eventScheme->getStartAt(),
            'endAt' => $eventScheme->getEndAt(),
            'explanation' => $eventScheme->getExplanation(),
            'detail' => $eventScheme->getDetail(),
            'plannerId' => $eventScheme->getPlannerId(),
        ]));
        $schemeEloquent = EventSchemeEloquent::find($eventScheme->getId());

        if (is_null($schemeEloquent)) {
            $schemeEloquent = new EventSchemeEloquent;
        }

        $schemeEloquent->name = $eventScheme->getName();
        $schemeEloquent->status = $eventScheme->getStatus()->value();
        $schemeEloquent->start_at = $eventScheme->getStartAt();
        $schemeEloquent->end_at = $eventScheme->getEndAt();
        $schemeEloquent->explanation = $eventScheme->getExplanation();
        $schemeEloquent->detail = $eventScheme->getDetail();

        $schemeEloquent->planner_id = $eventScheme->getPlannerId();
        $schemeEloquent->save();

        $id = $schemeEloquent->fresh()->id;

        return EventScheme::createRegistered(
            $id,
            $eventScheme->getName(),
            $eventScheme->getPlannerId(),
            $eventScheme->getStatus(),
            $eventScheme->getStartAt(),
            $eventScheme->getEndAt(),
            $eventScheme->getExplanation(),
            $eventScheme->getDetail(),
        );
    }
}
