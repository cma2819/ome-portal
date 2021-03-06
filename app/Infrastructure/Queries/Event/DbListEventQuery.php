<?php

namespace App\Infrastructure\Queries\Event;

use App\Infrastructure\Eloquents\AssociateEvent;
use Ome\Event\Interfaces\Dto\OmeEventDto;
use Ome\Event\Interfaces\Queries\ListEventQuery;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;

class DbListEventQuery implements ListEventQuery
{
    public function fetch(): array
    {
        $eventEloquents = AssociateEvent::query()
            ->orderBy('created_at')
            ->select([
                'id',
                'relate_type',
                'slug'
            ])
            ->get();

        $events = [];
        /** @var AssociateEvent */
        foreach ($eventEloquents as $event) {
            $events[] = new OmeEventDto(
                $event->id,
                RelateType::createFromValue($event->relate_type),
                Slug::create($event->slug)
            );
        }

        return $events;
    }
}
