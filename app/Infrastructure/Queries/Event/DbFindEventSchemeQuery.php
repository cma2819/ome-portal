<?php

namespace App\Infrastructure\Queries\Event;

use App\Infrastructure\Eloquents\EventScheme as EventSchemeEloquent;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Queries\FindEventSchemeQuery;
use Ome\Event\Values\SchemeStatus;

class DbFindEventSchemeQuery implements FindEventSchemeQuery
{
    public function fetch(int $id): ?EventScheme
    {
        $scheme = EventSchemeEloquent::find($id);

        if (is_null($scheme)) {
            return null;
        }

        return EventScheme::createRegistered(
            $scheme->id,
            $scheme->name,
            $scheme->planner_id,
            SchemeStatus::createFromValue($scheme->status),
            $scheme->start_at,
            $scheme->end_at,
            $scheme->explanation,
            $scheme->detail
        );
    }
}
