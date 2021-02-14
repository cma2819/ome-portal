<?php

namespace Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme;

/**
 * Make Detail For Event Scheme.
 */
interface MakeDetailForEventSchemeUseCase
{
    /**
     * Make Detail For Event Scheme.
     */
    public function interact(MakeDetailForEventSchemeRequest $request): MakeDetailForEventSchemeResponse;
}
