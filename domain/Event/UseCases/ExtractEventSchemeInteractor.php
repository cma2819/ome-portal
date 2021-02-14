<?php

namespace Ome\Event\UseCases;

use Ome\Event\Interfaces\Queries\ListEventSchemeQuery;
use Ome\Event\Interfaces\UseCases\ExtractEventScheme\ExtractEventSchemeRequest;
use Ome\Event\Interfaces\UseCases\ExtractEventScheme\ExtractEventSchemeResponse;
use Ome\Event\Interfaces\UseCases\ExtractEventScheme\ExtractEventSchemeUseCase;

class ExtractEventSchemeInteractor implements ExtractEventSchemeUseCase
{
    protected ListEventSchemeQuery $listEventSchemeQuery;

    public function __construct(
        ListEventSchemeQuery $listEventSchemeQuery
    ) {
        $this->listEventSchemeQuery = $listEventSchemeQuery;
    }

    public function interact(ExtractEventSchemeRequest $request): ExtractEventSchemeResponse
    {
        $schemes = $this->listEventSchemeQuery->fetch(
            $request->getPlannerId(),
            $request->getStatus(),
            $request->getStartAt(),
            $request->getEndAt()
        );

        return new ExtractEventSchemeResponse($schemes);
    }
}
