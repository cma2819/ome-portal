<?php

namespace Ome\Attendee\Entities;

use Ome\Attendee\Values\TaskScope;

class RunnerTask extends Task
{
    protected string $scope = 'runner';

    public static function createNewTask(string $content): self
    {
        return new self(null, $content, 'runner');
    }

    public static function createRegistered(int $id, string $content): self
    {
        return new self($id, $content, 'runner');
    }
}
