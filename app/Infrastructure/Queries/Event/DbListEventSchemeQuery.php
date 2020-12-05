<?php

namespace App\Infrastructure\Queries\Event;

use DateTimeInterface;
use App\Infrastructure\Eloquents\EventScheme as EventSchemeEloquent;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Queries\ListEventSchemeQuery;
use Ome\Event\Values\SchemeStatus;

class DbListEventSchemeQuery implements ListEventSchemeQuery
{
    public function fetch(?int $plannerId, ?array $status, ?DateTimeInterface $startAt, ?DateTimeInterface $endAt): array
    {
        $query = EventSchemeEloquent::query();

        if (!is_null($plannerId)) {
            $query = $query->where('planner_id', '=', $plannerId);
        }

        if (is_array($status)) {
            $inStatus = [];
            foreach ($status as $st) {
                $inStatus[] = $st->value();
            }

            $query = $query->whereIn('status', $inStatus);
        }

        if (!is_null($startAt)) {
            $query = $query->where('start_at', '>=', $startAt);
        }

        if (!is_null($endAt)) {
            $query = $query->where('end_at', '<=', $endAt);
        }

        $schemes = $query->select([
            'id', 'name', 'planner_id', 'status', 'start_at', 'end_at', 'explanation', 'detail',
        ])->get();

        return $schemes->map(function (EventSchemeEloquent $scheme) {
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
        })->all();
    }
}
