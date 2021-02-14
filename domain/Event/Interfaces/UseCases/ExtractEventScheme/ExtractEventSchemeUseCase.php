<?php

namespace Ome\Event\Interfaces\UseCases\ExtractEventScheme;

/**
 * Extract Event Scheme.
 */
interface ExtractEventSchemeUseCase
{
    /**
     * Extract Event Scheme.
     */
    public function interact(ExtractEventSchemeRequest $request): ExtractEventSchemeResponse;
}
