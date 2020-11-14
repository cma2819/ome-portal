<?php

namespace App\Infrastructure\Queries\Event;

use App\Infrastructure\Eloquents\AssociateEvent;
use Ome\Event\Interfaces\Dto\OmeEventDto;
use Ome\Event\Interfaces\Queries\FindEventQuery;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;

class FindEvent implements FindEventQuery
{
    public function fetch(string $id): ?OmeEventDto
    {
        $eventEloquent = AssociateEvent::find($id, [
            'relate_type',
            'slug'
        ]);

        if (is_null($eventEloquent)) {
            return null;
        }

        return new OmeEventDto(
            $id,
            RelateType::createFromValue($eventEloquent->relate_type),
            Slug::create($eventEloquent->slug)
        );
    }
}
