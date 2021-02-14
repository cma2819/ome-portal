<?php

namespace Ome\Event\Interfaces\UseCases\ExtractOengusEvent;

use Ome\Exceptions\EntityNotFoundException;

/**
 * Extract Oengus Event.
 */
interface ExtractOengusEventUseCase
{
    /**
     * Extract Oengus Event.
     *
     * @throws EntityNotFoundException
     */
    public function interact(ExtractOengusEventRequest $request): ExtractOengusEventResponse;
}
