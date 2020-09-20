<?php

namespace Ome\Attendee\Interfaces\UseCases\CreateAttendeeTask;

use Ome\Attendee\Values\TaskScope;

/**
 * Request object for CreateAttendeeTask.
 */
class CreateAttendeeTaskRequest
{
    private TaskScope $scope;

    private string $content;

    public function __construct(
        string $scope,
        string $content
    ) {
        $this->scope = TaskScope::createFromValue($scope);
        $this->content = $content;
    }

    /**
     * Get the value of scope
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }
}
