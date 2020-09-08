<?php

namespace App\Http\Responses\Api\Events;

use Carbon\Carbon;
use JsonSerializable;
use Ome\Event\Entities\Event;

class EventResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        Event $event
    ) {
        $this->json = [
            'name' => $event->getOengusMarathon()->getName(),
            'id' => $event->getId(),
            'relateType' => $event->getRelateType()->value(),
            'startAt' => Carbon::make($event->getOengusMarathon()->getStartAt())->toISOString(),
            'endAt' => Carbon::make($event->getOengusMarathon()->getEndAt())->toISOString(),
            'slug' => $event->getSlug()->value(),
            'submitsOpen' => $event->getOengusMarathon()->getSubmitsOpen(),
            'status' => $event->getOengusMarathon()->getStatus()->value()
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}
