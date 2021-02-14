<?php

namespace Ome\Event\Interfaces\UseCases\FindEventScheme;

/**
 * Find Event Scheme.
 */
interface FindEventSchemeUseCase
{
    /**
     * Find Event Scheme.
     */
    public function interact(FindEventSchemeRequest $request): FindEventSchemeResponse;
}
