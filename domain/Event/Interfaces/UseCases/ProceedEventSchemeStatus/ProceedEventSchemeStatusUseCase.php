<?php

namespace Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus;

/**
 * Proceed Event Scheme Status.
 */
interface ProceedEventSchemeStatusUseCase
{
    /**
     * Proceed Event Scheme Status.
     */
    public function interact(ProceedEventSchemeStatusRequest $request): ProceedEventSchemeStatusResponse;
}
