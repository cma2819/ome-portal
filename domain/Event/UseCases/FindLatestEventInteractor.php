<?php

namespace Ome\Event\UseCases;

use Carbon\Carbon;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Queries\ListEventQuery;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;
use Ome\Event\Interfaces\UseCases\FindLatestEvent\FindLatestEventRequest;
use Ome\Event\Interfaces\UseCases\FindLatestEvent\FindLatestEventResponse;
use Ome\Event\Interfaces\UseCases\FindLatestEvent\FindLatestEventUseCase;

class FindLatestEventInteractor implements FindLatestEventUseCase
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

    public function interact(FindLatestEventRequest $request): FindLatestEventResponse
    {
        $now = Carbon::make($request->getNow());
        $events = $this->listEventQuery->fetch();

        $latest = null;
        foreach ($events as $event) {
            $oengusMarathon = $this->oengusMarathonQuery->fetch(
                $event->getId(),
                $request->getNow()
            );

            if (is_null($latest)) {
                $latest = Event::createWithMarathon(
                    $oengusMarathon,
                    $event->getRelateType(),
                    $event->getSlug()
                );
                continue;
            }

            if (
                $oengusMarathon->getStartAt() <= $now
                && $now <= $oengusMarathon->getEndAt()
            ) {
                $latest = Event::createWithMarathon(
                    $oengusMarathon,
                    $event->getRelateType(),
                    $event->getSlug()
                );
                break;
            }

            if (
                $now->diffInSeconds($latest->getOengusMarathon()->getStartAt())
                    > ($now->diffInSeconds($oengusMarathon->getStartAt())
                )
            ) {
                $latest = Event::createWithMarathon(
                    $oengusMarathon,
                    $event->getRelateType(),
                    $event->getSlug()
                );
                continue;
            }
        }

        return new FindLatestEventResponse($latest);
    }
}
