<?php

namespace Ome\Attendee\Entities;

class VolunteerTask extends Task
{
    protected string $scope = 'volunteer';

    public static function createNewTask(string $content): Task
    {
        return new self(null, $content, 'volunteer');
    }

    public static function createRegistered(int $id, string $content): Task
    {
        return new self($id, $content, 'volunteer');
    }
}
