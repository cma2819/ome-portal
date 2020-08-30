<?php

namespace Ome\Event\UseCases;

use Ome\Event\Interfaces\Commands\DeleteEventCommand;
use Ome\Event\Interfaces\UseCases\DetachOengusMarathon\DetachOengusMarathonRequest;
use Ome\Event\Interfaces\UseCases\DetachOengusMarathon\DetachOengusMarathonResponse;
use Ome\Event\Interfaces\UseCases\DetachOengusMarathon\DetachOengusMarathonUseCase;

class DetachOengusMarathonInteractor implements DetachOengusMarathonUseCase
{
    private DeleteEventCommand $deleteEventCommand;

    public function __construct(
        DeleteEventCommand $deleteEventCommand
    ) {
        $this->deleteEventCommand = $deleteEventCommand;
    }

    public function interact(DetachOengusMarathonRequest $request): DetachOengusMarathonResponse
    {
        return new DetachOengusMarathonResponse(
            $this->deleteEventCommand->execute($request->getId())
        );
    }
}
