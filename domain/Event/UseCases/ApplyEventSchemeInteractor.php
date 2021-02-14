<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Commands\PersistEventSchemeCommand;
use Ome\Event\Interfaces\UseCases\ApplyEventScheme\ApplyEventSchemeRequest;
use Ome\Event\Interfaces\UseCases\ApplyEventScheme\ApplyEventSchemeResponse;
use Ome\Event\Interfaces\UseCases\ApplyEventScheme\ApplyEventSchemeUseCase;

class ApplyEventSchemeInteractor implements ApplyEventSchemeUseCase
{
    protected PersistEventSchemeCommand $persistEventScheme;

    public function __construct(
        PersistEventSchemeCommand $persistEventScheme
    ) {
        $this->persistEventScheme = $persistEventScheme;
    }

    public function interact(ApplyEventSchemeRequest $request): ApplyEventSchemeResponse
    {
        $newEventScheme = EventScheme::createNewScheme(
            $request->getName(),
            $request->getUserId(),
            $request->getStartAt(),
            $request->getEndAt(),
            $request->getExplanation()
        );

        return new ApplyEventSchemeResponse(
            $this->persistEventScheme->execute($newEventScheme)
        );
    }
}
