<?php

namespace Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent;

use Ome\Attendee\Values\TaskScope;

/**
 * Request object for RegisterAttendeeForEvent.
 */
class RegisterAttendeeForEventRequest
{
    private string $eventId;

    private int $userId;

    /** @var TaskScope[] */
    private array $scopes;

    public function __construct(
        string $eventId,
        int $userId,
        array $scopes
    ) {
        $this->eventId = $eventId;
        $this->userId = $userId;
        $this->scopes = [];
        foreach ($scopes as $scope) {
            $this->scopes[] = TaskScope::createFromValue($scope);
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
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }
}
