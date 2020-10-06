<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Queries\ListEventQuery;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;
use Ome\Event\Interfaces\UseCases\ListOengusEvent\ListOengusEventRequest;
use Ome\Event\Interfaces\UseCases\ListOengusEvent\ListOengusEventResponse;
use Ome\Event\Interfaces\UseCases\ListOengusEvent\ListOengusEventUseCase;

class ListOengusEventInteractor implements ListOengusEventUseCase
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

    public function interact(ListOengusEventRequest $request): ListOengusEventResponse
    {
        $omeEvents = $this->listEventQuery->fetch();

        $events = [];
        foreach ($omeEvents as $omeEvent) {
            $events[] = Event::createWithMarathon(
                $this->oengusMarathonQuery->fetch($omeEvent->getId(), $request->getNow()),
                $omeEvent->getRelateType(),
                $omeEvent->getSlug()
            );
        }

        return new ListOengusEventResponse($events);
    }
}
