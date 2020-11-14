<?php

namespace Ome\Attendee\Interfaces\UseCases\EditAttendeeTask;

use Ome\Attendee\Values\TaskScope;

/**
 * Request object for EditAttendeeTask.
 */
class EditAttendeeTaskRequest
{
    private TaskScope $scope;

    private int $id;

    private string $content;

    public function __construct(
        TaskScope $scope,
        int $id,
        string $content
    ) {
        $this->scope = $scope;
        $this->id = $id;
        $this->content = $content;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of scope
     */
    public function getScope()
    {
        return $this->scope;
    }
}
