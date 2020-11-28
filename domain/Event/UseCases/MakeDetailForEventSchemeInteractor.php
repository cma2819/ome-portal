<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Commands\PersistEventSchemeCommand;
use Ome\Event\Interfaces\Queries\FindEventSchemeQuery;
use Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme\MakeDetailForEventSchemeRequest;
use Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme\MakeDetailForEventSchemeResponse;
use Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme\MakeDetailForEventSchemeUseCase;
use Ome\Exceptions\EntityNotFoundException;

class MakeDetailForEventSchemeInteractor implements MakeDetailForEventSchemeUseCase
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

    public function interact(MakeDetailForEventSchemeRequest $request): MakeDetailForEventSchemeResponse
    {
        $scheme = $this->findEventScheme->fetch($request->getId());

        if (is_null($scheme)) {
            throw new EntityNotFoundException(EventScheme::class, [
                'id' => $request->getId()
            ]);
        }

        $result = $scheme->makeDetailForApproved($request->getDetail());
        return new MakeDetailForEventSchemeResponse($result);
    }
}
