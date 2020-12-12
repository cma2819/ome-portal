<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Commands\PersistEventSchemeCommand;
use Ome\Event\Interfaces\Queries\FindEventSchemeQuery;
use Ome\Event\Interfaces\UseCases\EditEventScheme\EditEventSchemeRequest;
use Ome\Event\Interfaces\UseCases\EditEventScheme\EditEventSchemeResponse;
use Ome\Event\Interfaces\UseCases\EditEventScheme\EditEventSchemeUseCase;
use Ome\Exceptions\EntityNotFoundException;

class EditEventSchemeInteractor implements EditEventSchemeUseCase
{

    protected FindEventSchemeQuery $findEventScheme;

    protected PersistEventSchemeCommand $persistEventScheme;

    public function __construct(
        FindEventSchemeQuery $findEventScheme,
        PersistEventSchemeCommand $persistEventScheme
    ) {
        $this->findEventScheme = $findEventScheme;
        $this->persistEventScheme = $persistEventScheme;
    }

    public function interact(EditEventSchemeRequest $request): EditEventSchemeResponse
    {
        $eventScheme = $this->findEventScheme->fetch($request->getId());

        if (is_null($eventScheme)) {
            throw new EntityNotFoundException(EventScheme::class, [
                'id' => $request->getId()
            ]);
        }

        $result = $eventScheme->editAppliedScheme(
            $request->getName(),
            $request->getStartAt(),
            $request->getEndAt(),
            $request->getExplanation()
        );
        $this->persistEventScheme->execute($result);

        return new EditEventSchemeResponse($result);
    }
}
