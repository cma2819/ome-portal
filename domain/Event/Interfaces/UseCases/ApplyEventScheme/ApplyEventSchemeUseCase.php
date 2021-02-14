<?php

namespace Ome\Event\Interfaces\UseCases\ApplyEventScheme;

/**
 * Apply Event Scheme.
 */
interface ApplyEventSchemeUseCase
{
    /**
     * Apply Event Scheme.
     */
    public function interact(ApplyEventSchemeRequest $request): ApplyEventSchemeResponse;
}
