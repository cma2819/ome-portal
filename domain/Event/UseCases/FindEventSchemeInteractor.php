<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Queries\FindEventSchemeQuery;
use Ome\Event\Interfaces\UseCases\FindEventScheme\FindEventSchemeRequest;
use Ome\Event\Interfaces\UseCases\FindEventScheme\FindEventSchemeResponse;
use Ome\Event\Interfaces\UseCases\FindEventScheme\FindEventSchemeUseCase;
use Ome\Exceptions\EntityNotFoundException;

class FindEventSchemeInteractor implements FindEventSchemeUseCase
{
    protected FindEventSchemeQuery $findEventScheme;

    public function __construct(
        FindEventSchemeQuery $findEventScheme
    ) {
        $this->findEventScheme = $findEventScheme;
    }

    public function interact(FindEventSchemeRequest $request): FindEventSchemeResponse
    {
        $scheme = $this->findEventScheme->fetch($request->getId());

        if (is_null($scheme)) {
            throw new EntityNotFoundException(EventScheme::class, [
                'id' => $request->getId()
            ]);
        }

        return new FindEventSchemeResponse($scheme);
    }
}
