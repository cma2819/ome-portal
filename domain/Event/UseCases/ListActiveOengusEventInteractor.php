<?php

namespace Ome\Event\UseCases;

use Carbon\Carbon;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Queries\ListEventQuery;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;
use Ome\Event\Interfaces\UseCases\ListActiveOengusEvent\ListActiveOengusEventRequest;
use Ome\Event\Interfaces\UseCases\ListActiveOengusEvent\ListActiveOengusEventResponse;
use Ome\Event\Interfaces\UseCases\ListActiveOengusEvent\ListActiveOengusEventUseCase;

class ListActiveOengusEventInteractor implements ListActiveOengusEventUseCase
{
    protected ListEventQuery $listEventQuery;

    protected OengusMarathonQuery $oengusMarathonQuery;

    public function __construct(
        ListEventQuery $listEventQuery,
        OengusMarathonQuery $oengusMarathonQuery
    ) {
        $this->listEventQuery = $listEventQuery;
        $this->oengusMarathonQuery = $oengusMarathonQuery;
    }

    public function interact(ListActiveOengusEventRequest $request): ListActiveOengusEventResponse
    {
        $omeEvents = $this->listEventQuery->fetch();

        $events = [];
        foreach ($omeEvents as $omeEvent) {
            $event = Event::createWithMarathon(
                $this->oengusMarathonQuery->fetch($omeEvent->getId()),
                $omeEvent->getRelateType(),
                $omeEvent->getSlug()
            );

            if ($event->getOengusMarathon()->isActiveAt($request->getNow())) {
                $events[] = $event;
            }
        }

        return new ListActiveOengusEventResponse($events);
    }
}
