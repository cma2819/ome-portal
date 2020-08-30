<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Commands\PersistEventCommand;
use Ome\Event\Interfaces\UseCases\SaveOengusEvent\SaveOengusEventRequest;
use Ome\Event\Interfaces\UseCases\SaveOengusEvent\SaveOengusEventResponse;
use Ome\Event\Interfaces\UseCases\SaveOengusEvent\SaveOengusEventUseCase;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;

class SaveOengusEventInteractor implements SaveOengusEventUseCase
{
    protected PersistEventCommand $persistEvent;

    public function __construct(
        PersistEventCommand $persistEvent
    ) {
        $this->persistEvent = $persistEvent;
    }

    public function interact(SaveOengusEventRequest $request): SaveOengusEventResponse
    {
        $event = Event::createWithMarathon(
            $request->getOengusMarathon(),
            RelateType::createFromValue($request->getRelateType()),
            Slug::create($request->getSlug())
        );

        $result = $this->persistEvent->execute($event);

        return new SaveOengusEventResponse($result);
    }
}
