<?php

namespace Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent;

use Ome\Attendee\Values\TaskScope;
use Ome\Exceptions\UnmatchedContextException;

/**
 * Request object for ListAttendeesInEvent.
 */
class ListAttendeesInEventRequest
{
    private string $eventId;

    /** @var TaskScope[] */
    private ?array $scopes;

    /**
     * @param string $eventId
     * @param string|null $scopes
     */
    public function __construct(
        string $eventId,
        ?array $scopes = null
    ) {
        $this->eventId = $eventId;
        if (is_array($scopes)) {
            $this->scopes = [];
            foreach ($scopes as $scope) {
                try {
                    $attendeeScope = TaskScope::createFromValue($scope);
                    $this->scopes[] = $attendeeScope;
                } catch (UnmatchedContextException $e) {
                    // DO nothing, invalid parameter is ignored.
                }
            }
        }
    }

    /**
     * Get the value of eventId
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Get the value of scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }
}
