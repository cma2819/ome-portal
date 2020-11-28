<?php

namespace Ome\Event\UseCases;

use Ome\Event\Interfaces\Commands\PersistEventSchemeCommand;
use Ome\Event\Interfaces\Queries\FindEventSchemeQuery;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusRequest;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusResponse;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusUseCase;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\UnmatchedContextException;

class ProceedEventSchemeStatusInteractor implements ProceedEventSchemeStatusUseCase
{
    protected PersistEventSchemeCommand $persistEventScheme;

    protected FindEventSchemeQuery $findEventScheme;

    public function __construct(
        PersistEventSchemeCommand $persistEventScheme,
        FindEventSchemeQuery $findEventScheme
    ) {
        $this->persistEventScheme = $persistEventScheme;
        $this->findEventScheme = $findEventScheme;
    }

    public function interact(ProceedEventSchemeStatusRequest $request): ProceedEventSchemeStatusResponse
    {
        $eventScheme = $this->findEventScheme->fetch($request->getId());

        if (is_null($eventScheme)) {
            throw new UnmatchedContextException(self::class, 'EventScheme has ID ['. $request->getId() . '] is not found');
        }
        $status = SchemeStatus::createFromValue($request->getStatus());
        $eventScheme->proceed($status);

        return new ProceedEventSchemeStatusResponse(
            $this->persistEventScheme->execute($eventScheme)
        );
    }
}
