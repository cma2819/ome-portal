<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Queries\FindEventQuery;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;
use Ome\Event\Interfaces\UseCases\ExtractOengusEvent\ExtractOengusEventRequest;
use Ome\Event\Interfaces\UseCases\ExtractOengusEvent\ExtractOengusEventResponse;
use Ome\Event\Interfaces\UseCases\ExtractOengusEvent\ExtractOengusEventUseCase;
use Ome\Exceptions\EntityNotFoundException;

class ExtractOengusEventInteractor implements ExtractOengusEventUseCase
{
    protected FindEventQuery $findEventQuery;

    protected OengusMarathonQuery $oengusMarathonQuery;

    public function __construct(
        FindEventQuery $findEventQuery,
        OengusMarathonQuery $oengusMarathonQuery
    ) {
        $this->findEventQuery = $findEventQuery;
        $this->oengusMarathonQuery = $oengusMarathonQuery;
    }

    public function interact(ExtractOengusEventRequest $request): ExtractOengusEventResponse
    {
        $omeEvent = $this->findEventQuery->fetch($request->getId());
        if (is_null($omeEvent)) {
            throw new EntityNotFoundException(Event::class, ['id' => $request->getId()]);
        }

        $marathon = $this->oengusMarathonQuery->fetch($request->getId(), $request->getNow());

        return new ExtractOengusEventResponse(
            Event::createWithMarathon($marathon, $omeEvent->getRelateType(), $omeEvent->getSlug())
        );
    }
}
