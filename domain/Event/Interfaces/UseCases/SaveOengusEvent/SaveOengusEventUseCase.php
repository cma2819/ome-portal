<?php

namespace Ome\Event\Interfaces\UseCases\SaveOengusEvent;

/**
 * Save Oengus Event.
 */
interface SaveOengusEventUseCase
{
    /**
     * Save Oengus Event.
     */
    public function interact(SaveOengusEventRequest $request): SaveOengusEventResponse;
}
